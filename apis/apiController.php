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

    public function logs() {
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
            $con->query("DELETE FROM CATEGORIES_PRODUCTS WHERE id_product = $id");
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

        $stmt = $con->prepare("SELECT * FROM ORDERS");

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
            $stmt = $con->prepare("SELECT * FROM ORDERS WHERE id_user = ?");
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

    public function getOrderCoupons() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if an 'order' parameter is provided in the GET request
        $order = $_GET['order'] ?? null;

        if ($order) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare("SELECT * FROM COUPONS_ORDERS WHERE id_order = ?");
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

    public function getOrderContainers() {
        apiController::getHeaders();
        if (!apiController::protection()) {
            return;
        }

        $con = DataBase::connect();

        // Check if an 'order' parameter is provided in the GET request
        $order = $_GET['order'] ?? null;

        if ($order) {
            // Fetch a specific record by the dynamic ID column
            $stmt = $con->prepare("SELECT * FROM CONTAINERS WHERE id_order = ?");
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

    public function getSales() {
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

    public function getEstablishment() {
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

    public function getContainerPart() {
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
}

?>