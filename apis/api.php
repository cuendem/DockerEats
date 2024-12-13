<?php


// Include database configuration and models
include_once("../config/dataBase.php");

// Start session
session_start();

// Determine the request method and parameters
$method = $_SERVER['REQUEST_METHOD'];
$table = $_GET['table'] ?? null;
$action = $_GET['action'] ?? null;

// Allowed tables for security
$allowedTables = DataBase::getAllTables();

// Validate the table parameter
if (!$table || !in_array($table, $allowedTables)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid or missing table specified']);
    exit;
}

// Handle different request methods
switch ($method) {
    case 'GET':
        handleRead($table);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        handleCreate($table, $data);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        handleUpdate($table, $data);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        handleDelete($table, $data);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}

// Function to generate the dynamic ID column name based on the table name
function getIdColumnName($table) {
    if (preg_match('/IES$/', $table)) {
        // If the table name ends with 'IES', replace 'IES' with 'y'
        // Weird plurals like country -> countries or category -> categories
        $baseName = substr($table, 0, -3) . 'y';
    } else {
        // Otherwise, remove the last character (the plural s)
        $baseName = substr($table, 0, -1);
    }

    return "id_" . strtolower($baseName);
}

// Function to handle reading data
function handleRead($table) {
    $con = DataBase::connect();

    // Get the dynamic ID column name
    $idColumn = getIdColumnName($table);

    // Check if an 'id' parameter is provided in the GET request
    $id = $_GET['id'] ?? null;

    if ($id) {
        // Fetch a specific record by the dynamic ID column
        $stmt = $con->prepare("SELECT * FROM `$table` WHERE `$idColumn` = ?");
        $stmt->bind_param('i', $id);
    } else {
        // Fetch all records
        $stmt = $con->prepare("SELECT * FROM `$table`");
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $con->close();

    if ($id && count($data) === 0) {
        // If an id was specified but no record was found
        http_response_code(404);
        echo json_encode(['error' => 'Record not found']);
    } else {
        // Return the data (either all records or the specific record)
        echo json_encode($data);
    }
}

// Function to handle creating data
function handleCreate($table, $data) {
    $con = DataBase::connect();

    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $types = str_repeat('s', count($data));

    $stmt = $con->prepare("INSERT INTO `$table` ($columns) VALUES ($placeholders)");
    $stmt->bind_param($types, ...array_values($data));

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Record created successfully', 'id' => $con->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Create failed: ' . $con->error]);
    }

    $con->close();
}

// Function to handle updating data
function handleUpdate($table, $data) {
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID is required for update']);
        return;
    }

    // Get the dynamic ID column name
    $idColumn = getIdColumnName($table);

    $id = $data['id'];

    $setClause = implode(', ', array_map(fn($col) => "$col = ?", array_keys($data)));
    $types = str_repeat('s', count($data)) . 'i';

    $con = DataBase::connect();
    $stmt = $con->prepare("UPDATE `$table` SET $setClause WHERE `$idColumn` = ?");
    $params = array_merge(array_values($data), [$id]);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Record updated successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Update failed: ' . $con->error]);
    }

    $con->close();
}

// Function to handle deleting data
function handleDelete($table, $data) {
    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID is required for delete']);
        return;
    }

    // Get the dynamic ID column name
    $idColumn = getIdColumnName($table);

    $id = $data['id'];
    $con = DataBase::connect();
    $stmt = $con->prepare("DELETE FROM `$table` WHERE `$idColumn` = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Record deleted successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Delete failed: ' . $con->error]);
    }

    $con->close();
}

?>