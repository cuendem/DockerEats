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