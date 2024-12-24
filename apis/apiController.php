<?php

include_once("config/DataBase.php");
include_once("controllers/logsController.php");

class apiController {
    private static function getHeaders() {
        $allowedOrigin = "http://dockereats.com";
        header("Access-Control-Allow-Origin: $allowedOrigin");

        // General headers
        header("Content-Type: application/json; charset=UTF-8");

        // Allowed HTTP methods
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

        // Allowed headers for requests
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

        // Allow credentials (if required, e.g., for cookies/sessions)
        header("Access-Control-Allow-Credentials: true");
    }

    private static function protection() {
        // Check if the user is authenticated
        if (isset($_SESSION['username']) && $_SESSION['id_user'] == 1) {
            return true;
        } else {
            http_response_code(403); // Forbidden
            echo json_encode(['error' => 'Unauthorized access']);
            return false;
        }
    }

    public function index() {
        if (!isset($_SESSION['username']) || $_SESSION['id_user'] != 1) {
            header('Location:/');
        }

        $pageid = "admin";
        $title = "Administration console";
        $view = "admin/views/index.php";

        include_once("views/main.php");
    }

    public function orders() {
        if (!isset($_SESSION['username']) || $_SESSION['id_user'] != 1) {
            header('Location:/');
        }

        $pageid = "admin";
        $title = "Order administration";
        $view = "admin/views/orders.php";

        include_once("views/main.php");
    }

    public function products() {
        if (!isset($_SESSION['username']) || $_SESSION['id_user'] != 1) {
            header('Location:/');
        }

        $pageid = "admin";
        $title = "Product administration";
        $view = "admin/views/products.php";

        include_once("views/main.php");
    }

    public function users() {
        if (!isset($_SESSION['username']) || $_SESSION['id_user'] != 1) {
            header('Location:/');
        }

        $pageid = "admin";
        $title = "User administration";
        $view = "admin/views/users.php";

        include_once("views/main.php");
    }

    public function sales() {
        if (!isset($_SESSION['username']) || $_SESSION['id_user'] != 1) {
            header('Location:/');
        }

        $pageid = "admin";
        $title = "Sale administration";
        $view = "admin/views/sales.php";

        include_once("views/main.php");
    }

    public function coupons() {
        if (!isset($_SESSION['username']) || $_SESSION['id_user'] != 1) {
            header('Location:/');
        }

        $pageid = "admin";
        $title = "Coupon administration";
        $view = "admin/views/coupons.php";

        include_once("views/main.php");
    }

    public function log() {
        if (!isset($_SESSION['username']) || $_SESSION['id_user'] != 1) {
            header('Location:/');
        }

        $pageid = "admin";
        $title = "Logs";
        $view = "admin/views/logs.php";

        include_once("views/main.php");
    }

    public static function getProduct() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if an 'id' parameter is provided in the GET request
        $id = $_GET['id'] ?? null;

        if ($id) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE id_product = ?");
            $stmt->bind_param('i', $id);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if ($id && count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data[0]);
        }
    }

    public static function getProducts() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM PRODUCTS");

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if (count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getDeletedProducts() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE deleted = 1");

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if (count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getProductsByType() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if a 'type' parameter is provided in the GET request
        $type = $_GET['type'] ?? null;

        if ($type) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare("SELECT * FROM PRODUCTS WHERE id_type = ?");
            $stmt->bind_param('i', $type);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if ($type && count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function editProduct() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Collect and validate input parameters
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? null;
        $price = $_POST['price'] ?? null;
        $type = $_POST['type'] ?? null;
        $categories = $_POST['categories'] ?? null;
        $image = $_FILES['image'] ?? null;

        if (!$id || !$name || !$price || !$type || !$categories) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required parameters']);
            return;
        }

        try {
            // Check if the product exists before updating
            $checkStmt = $con->prepare("SELECT id_product FROM PRODUCTS WHERE id_product = ?");
            $checkStmt->bind_param('i', $id);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows === 0) {
                // Product with the given ID does not exist
                http_response_code(404);
                echo json_encode(['error' => 'No product found with the given ID']);
                return;
            }

            // Update product information
            $stmt = $con->prepare("UPDATE PRODUCTS SET id_type = ?, name = ?, price = ? WHERE id_product = ?");
            $stmt->bind_param('isdi', $type, $name, $price, $id);
            $stmt->execute();

            // Handle updating categories
            $stmt = $con->prepare("DELETE FROM CATEGORIES_PRODUCTS WHERE id_product = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $categoryIds = explode(',', $categories);
            foreach ($categoryIds as $categoryId) {
                $stmt = $con->prepare("INSERT INTO CATEGORIES_PRODUCTS (id_product, id_category) VALUES (?, ?)");
                $stmt->bind_param('ii', $id, $categoryId);
                $stmt->execute();
            }

            if ($image && $image['name'] != '') {
                $originalExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                $imgName = 'product'.$id.'.webp';
                $path = 'img/products/'.$imgName;

                // Load the image based on its original type
                switch ($originalExtension) {
                    case 'jpeg':
                    case 'jpg':
                        $image = imagecreatefromjpeg($image['tmp_name']);
                        break;
                    case 'png':
                        $image = imagecreatefrompng($image['tmp_name']);
                        break;
                    case 'gif':
                        $image = imagecreatefromgif($image['tmp_name']);
                        break;
                    case 'webp':
                        $image = imagecreatefromwebp($image['tmp_name']);
                        break;
                    default:
                        die("Unsupported image format!");  // Handle unsupported formats
                }

                if ($image) {
                    // Get original dimensions
                    $originalW = imagesx($image);
                    $originalH = imagesy($image);

                    // Determine square crop dimensions
                    $size = min($originalW, $originalH);
                    $x = ($originalW > $originalH) ? ($originalW - $originalH) / 2 : 0;
                    $y = ($originalH > $originalW) ? ($originalH - $originalW) / 2 : 0;

                    // Create a square crop
                    $croppedImage = imagecrop($image, ['x' => $x, 'y' => $y, 'width' => $size, 'height' => $size]);
                    if ($croppedImage === false) {
                        die("Failed to crop image.");
                    }

                    // Resize the cropped image to 250x250
                    $resizedImage = imagescale($croppedImage, 250, 250);

                    // Save the image as WebP
                    imagewebp($resizedImage, $path, 80);  // 80 is the quality level

                    // Free up memory
                    imagedestroy($image);
                    imagedestroy($croppedImage);
                    imagedestroy($resizedImage);
                }
            }

            logsController::log("Updated product $id");

            http_response_code(200);
            echo json_encode(['success' => 'Product updated successfully']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
        } finally {
            $con->close();
        }
    }

    public static function addProduct() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Collect and validate input parameters
        $name = $_POST['name'] ?? null;
        $price = $_POST['price'] ?? null;
        $type = $_POST['type'] ?? null;
        $categories = $_POST['categories'] ?? null;
        $image = $_FILES['image'] ?? null;

        if (!$name || !$price || !$type || !$categories) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required parameters']);
            return;
        }

        try {
            // Update product information
            $stmt = $con->prepare("INSERT INTO PRODUCTS (id_type, name, price) VALUES (?, ?, ?)");
            $stmt->bind_param('isd', $type, $name, $price);
            $stmt->execute();

            $id = $con->insert_id;

            // Handle updating categories
            $categoryIds = explode(',', $categories);
            foreach ($categoryIds as $categoryId) {
                $stmt = $con->prepare("INSERT INTO CATEGORIES_PRODUCTS (id_product, id_category) VALUES (?, ?)");
                $stmt->bind_param('ii', $id, $categoryId);
                $stmt->execute();
            }

            if ($image && $image['name'] != '') {
                $originalExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                $imgName = 'product'.$id.'.webp';
                $path = 'img/products/'.$imgName;

                // Load the image based on its original type
                switch ($originalExtension) {
                    case 'jpeg':
                    case 'jpg':
                        $image = imagecreatefromjpeg($image['tmp_name']);
                        break;
                    case 'png':
                        $image = imagecreatefrompng($image['tmp_name']);
                        break;
                    case 'gif':
                        $image = imagecreatefromgif($image['tmp_name']);
                        break;
                    case 'webp':
                        $image = imagecreatefromwebp($image['tmp_name']);
                        break;
                    default:
                        die("Unsupported image format!");  // Handle unsupported formats
                }

                // Get original dimensions
                $originalW = imagesx($image);
                $originalH = imagesy($image);

                // Determine square crop dimensions
                $size = min($originalW, $originalH);
                $x = ($originalW > $originalH) ? ($originalW - $originalH) / 2 : 0;
                $y = ($originalH > $originalW) ? ($originalH - $originalW) / 2 : 0;

                // Create a square crop
                $croppedImage = imagecrop($image, ['x' => $x, 'y' => $y, 'width' => $size, 'height' => $size]);
                if ($croppedImage === false) {
                    die("Failed to crop image.");
                }

                // Resize the cropped image to 250x250
                $resizedImage = imagescale($croppedImage, 250, 250);

                // Save the image as WebP
                imagewebp($resizedImage, $path, 80);  // 80 is the quality level

                // Free up memory
                imagedestroy($image);
                imagedestroy($croppedImage);
                imagedestroy($resizedImage);
            }

            logsController::log("Created product $id");

            http_response_code(200);
            echo json_encode(['success' => 'Product created successfully']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
        } finally {
            $con->close();
        }
    }

    public static function deleteProduct() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Read and decode the JSON input
        $inputData = json_decode(file_get_contents('php://input'), true);

        $id = $inputData['id'] ?? null;
        $deleted = $inputData['deleted'] ?? null;

        if (!isset($id) || !isset($deleted)) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required parameters']);
            return;
        }

        try {
            // Check if the product exists before updating
            $checkStmt = $con->prepare("SELECT id_product FROM PRODUCTS WHERE id_product = ?");
            $checkStmt->bind_param('i', $id);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows === 0) {
                // Product with the given ID does not exist
                http_response_code(404);
                echo json_encode(['error' => 'No product found with the given ID']);
                return;
            }

            // Check if the product is already marked as deleted
            $checkDeletedStmt = $con->prepare("SELECT deleted FROM PRODUCTS WHERE id_product = ?");
            $checkDeletedStmt->bind_param('i', $id);
            $checkDeletedStmt->execute();
            $checkDeletedResult = $checkDeletedStmt->get_result();
            $product = $checkDeletedResult->fetch_assoc();

            if ($product['deleted'] == $deleted) {
                http_response_code(200);
                echo json_encode(['success' => 'Product status is already set to the requested value']);
                return;
            }

            // Update product information if not already marked as deleted
            $stmt = $con->prepare("UPDATE PRODUCTS SET deleted = ? WHERE id_product = ?");
            $stmt->bind_param('ii', $deleted, $id);
            $stmt->execute();

            if ($deleted == 1) {
                logsController::log("Marked product $id as deleted");
            } else {
                logsController::log("Unmarked product $id as deleted");
            }

            http_response_code(200);
            echo json_encode(['success' => 'Product disabled successfully']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
        } finally {
            $con->close();
        }
    }

    public static function getCategories() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM CATEGORIES ORDER BY name");

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if (count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getCategoriesproducts() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM CATEGORIES_PRODUCTS");

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if (count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getUser() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if an 'id' parameter is provided in the GET request
        $id = $_GET['id'] ?? null;

        if ($id) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare("SELECT * FROM USERS WHERE id_user = ?");
            $stmt->bind_param('i', $id);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if ($id && count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data[0]);
        }
    }

    public static function getUsers() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM USERS");

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if (count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    // Get all orders
    public static function getOrders() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT
            o.id_order,
            o.date_order,
            o.delivery_address,
            o.payment_type,
            o.card_number,
            o.expiration_date,
            o.cvc,
            o.card_holder,
            u.id_user,
            u.username,
            e.id_establishment,
            e.name AS establishment_name
        FROM
            ORDERS o
        LEFT JOIN USERS u ON o.id_user = u.id_user
        LEFT JOIN ESTABLISHMENTS e ON o.id_establishment = e.id_establishment
        ORDER BY o.id_order DESC");

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if (count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    // Get orders by user
    public static function getOrdersByUser() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if a 'user' parameter is provided in the GET request
        $user = $_GET['user'] ?? null;

        if ($user) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare("SELECT
                o.id_order,
                o.date_order,
                o.delivery_address,
                o.payment_type,
                o.card_number,
                o.expiration_date,
                o.cvc,
                o.card_holder,
                u.id_user,
                u.username,
                e.id_establishment,
                e.name AS establishment_name
            FROM
                ORDERS o
            LEFT JOIN USERS u ON o.id_user = u.id_user
            LEFT JOIN ESTABLISHMENTS e ON o.id_establishment = e.id_establishment
            WHERE u.id_user = ?
            ORDER BY o.id_order DESC");
            $stmt->bind_param('i', $user);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if ($user && count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getOrderCoupons() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if an 'order' parameter is provided in the GET request
        $order = $_GET['order'] ?? null;

        if ($order) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare('
            SELECT c.*
            FROM COUPONS_ORDERS co
            JOIN COUPONS c ON co.id_coupon = c.id_coupon
            WHERE co.id_order LIKE ?
        ');
            $stmt->bind_param('i', $order);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if ($order && count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getOrderContainers() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if an 'order' parameter is provided in the GET request
        $order = $_GET['order'] ?? null;

        if (!$order) {
            http_response_code(400);
            echo json_encode(['error' => 'Order ID is required']);
            return;
        }

        // Fetch containers and their parts for the specified order
        $stmt = $con->prepare("
            SELECT 
                c.id_container,
                cp.id_part,
                cp.id_product,
                p.name AS product_name,
                p.price AS product_price,
                p.id_type AS product_type
            FROM CONTAINERS c
            LEFT JOIN CONTAINER_PARTS cp ON c.id_container = cp.id_container
            LEFT JOIN PRODUCTS p ON cp.id_product = p.id_product
            WHERE c.id_order = ?
        ");
        $stmt->bind_param('i', $order);
        $stmt->execute();
        $result = $stmt->get_result();

        // Group results by container
        $containers = [];
        while ($row = $result->fetch_assoc()) {
            $containerId = $row['id_container'];
            if (!isset($containers[$containerId])) {
                $containers[$containerId] = [
                    'id_container' => $containerId,
                    'parts' => []
                ];
            }

            // Add the part to the container's parts array
            $containers[$containerId]['parts'][] = [
                'id_part' => $row['id_part'],
                'id_product' => $row['id_product'],
                'product_name' => $row['product_name'],
                'product_price' => $row['product_price'],
                'product_type' => $row['product_type']
            ];
        }

        $con->close();

        // Convert the grouped containers to a regular array
        $containers = array_values($containers);

        if (empty($containers)) {
            http_response_code(404);
            echo json_encode(['error' => 'No containers found for the specified order']);
        } else {
            // Return the data
            echo json_encode($containers);
        }
    }   

    public static function getSales() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Fetch a specific record by the dynamic ID column
        $stmt = $con->prepare("SELECT * FROM SALES");

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if (count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getSalesByPart() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if a 'part' parameter is provided in the GET request
        $part = $_GET['part'] ?? null;

        if (!$part) {
            http_response_code(400);
            echo json_encode(['error' => 'Part ID is required']);
            return;
        }

        // Fetch a specific record by the dynamic ID column
        $stmt = $con->prepare('SELECT s.* FROM SALES as s JOIN SALES_CONTAINER_PARTS as scp ON s.id_sale = scp.id_sale WHERE scp.id_part = ?');
        $stmt->bind_param('i', $part);

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        // Return the data
        echo json_encode($data);
    }

    public static function getProductCategories() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if a 'product' parameter is provided in the GET request
        $product = $_GET['product'] ?? null;

        if (!$product) {
            http_response_code(400);
            echo json_encode(['error' => 'Product ID is required']);
            return;
        }

        $stmt = $con->prepare('SELECT id_category FROM CATEGORIES_PRODUCTS WHERE id_product LIKE ?');
        $stmt->bind_param('i', $product);
        $stmt->execute();
        $result = $stmt->get_result();

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['id_category'];
        }

        $con->close();

        if (count($categories) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($categories);
        }
    }

    public static function getEstablishment() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if an 'id' parameter is provided in the GET request
        $id = $_GET['id'] ?? null;

        if ($id) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare("SELECT * FROM ESTABLISHMENTS WHERE id_establishment = ?");
            $stmt->bind_param('i', $id);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if ($id && count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data[0]);
        }
    }

    public static function getContainerPart() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if an 'id' parameter is provided in the GET request
        $container = $_GET['container'] ?? null;
        $part = $_GET['part'] ?? null;

        if ($container && $part) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare("SELECT * FROM CONTAINER_PARTS WHERE id_part = ? AND id_container = ?");
            $stmt->bind_param('ii', $part, $container);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if ($container && $part && count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data[0]);
        }
    }

    public static function getLogs() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Fetch a specific record by the dynamic ID column
        $stmt = $con->prepare("SELECT *
        FROM LOGS AS L
        JOIN USERS AS U ON L.id_user = U.id_user
        ORDER BY id_log DESC");

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if (count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getLogsButAdmin() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Fetch a specific record by the dynamic ID column
        $stmt = $con->prepare("SELECT *
        FROM LOGS AS L
        JOIN USERS AS U ON L.id_user = U.id_user
        WHERE U.id_user != 1
        ORDER BY id_log DESC");

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if (count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getLogsByUser() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if a 'user' parameter is provided in the GET request
        $user = $_GET['user'] ?? null;

        if ($user) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare("SELECT *
            FROM LOGS AS L
            JOIN USERS AS U ON L.id_user = U.id_user
            WHERE L.id_user = ?
            ORDER BY id_log DESC");
            $stmt->bind_param('i', $user);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if ($user && count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function getSalesByOrder() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if an 'order' parameter is provided in the GET request
        $order = $_GET['order'] ?? null;

        if ($order) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare('SELECT s.* FROM SALES as s JOIN SALES_ORDERS as so ON s.id_sale = so.id_sale WHERE so.id_order = ?');
            $stmt->bind_param('i', $order);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $con->close();

        if ($order && count($data) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Record not found']);
        } else {
            // Return the data
            echo json_encode($data);
        }
    }

    public static function deleteOrder() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();
        $inputData = json_decode(file_get_contents('php://input'), true);

        $id = $inputData['id'] ?? null;

        if (!isset($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required parameters']);
            return;
        }

        try {
            // Check if the order exists before deleting
            $checkStmt = $con->prepare("SELECT id_order FROM ORDERS WHERE id_order = ?");
            $checkStmt->bind_param('i', $id);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows === 0) {
                // Order with the given ID does not exist
                http_response_code(404);
                echo json_encode(['error' => 'No order found with the given ID']);
                return;
            }

            // Delete order
            $stmt = $con->prepare("DELETE FROM ORDERS WHERE id_order = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();

            logsController::log("Deleted order $id");

            http_response_code(200);
            echo json_encode(['success' => 'Order deleted successfully']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
        } finally {
            $con->close();
        }
    }

    public static function deleteContainer() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();
        $inputData = json_decode(file_get_contents('php://input'), true);

        $id = $inputData['id'] ?? null;

        if (!isset($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required parameters']);
            return;
        }

        try {
            // Check if the container exists before deleting
            $checkStmt = $con->prepare("SELECT id_container FROM CONTAINERS WHERE id_container = ?");
            $checkStmt->bind_param('i', $id);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows === 0) {
                // Container with the given ID does not exist
                http_response_code(404);
                echo json_encode(['error' => 'No container found with the given ID']);
                return;
            }

            // Delete container
            $stmt = $con->prepare("DELETE FROM CONTAINERS WHERE id_container = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();

            logsController::log("Deleted container $id");

            http_response_code(200);
            echo json_encode(['success' => 'Container deleted successfully']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
        } finally {
            $con->close();
        }
    }
}

?>