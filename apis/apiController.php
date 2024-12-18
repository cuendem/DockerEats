<?php

class apiController {
    private static function getHeaders() {
        // CORS Headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
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

    public static function getProduct() {
        apiController::getHeaders();
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

    public static function getProductsByType() {
        apiController::getHeaders();
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
            $con = DataBase::connect();

            // Read and decode the JSON input
            $inputData = json_decode(file_get_contents('php://input'), true);

            $id = $inputData['id'] ?? null;
            $deleted = $inputData['deleted'] ?? null;

            // Debugging: Check what the input looks like
            // This should be removed once you're sure the inputs are correct
            error_log(print_r($inputData, true)); 

            if (!$id || !$deleted) {
                http_response_code(400);
                echo json_encode(['error' => 'Missing required parameters']);
                return;
            }

            try {
                // Check if the product exists before updating
                $checkStmt = $con->prepare("SELECT id_product FROM PRODUCTS WHERE id_product = ? AND deleted = 0");
                $checkStmt->bind_param('i', $id);
                $checkStmt->execute();
                $checkResult = $checkStmt->get_result();

                if ($checkResult->num_rows === 0) {
                    // Product with the given ID does not exist
                    http_response_code(404);
                    echo json_encode(['error' => 'No undeleted product found with the given ID']);
                    return;
                }

                // Update product information
                $stmt = $con->prepare("UPDATE PRODUCTS SET deleted = ? WHERE id_product = ?");
                $stmt->bind_param('ii', $deleted, $id);
                $stmt->execute();

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
}

?>