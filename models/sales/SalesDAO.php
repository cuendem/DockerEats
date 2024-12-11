<?php

include_once("models/sales/Sale.php");
include_once("config/dataBase.php");

class SalesDAO {
    public static function getAll() {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM SALES');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $sales = [];
        while ($sale = $result->fetch_object("Sale")) {
            $sales[] = $sale;
        }

        $con->close();

        return $sales;
    }

    public static function getAllAvailable($date, $scope = '%') {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE and date validity checks
        $stmt = $con->prepare('SELECT * FROM SALES WHERE date_start <= ? AND (date_end IS NULL OR date_end >= ?) AND scope LIKE ?');

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('sss', $date, $date, $scope);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $sales = [];
        while ($sale = $result->fetch_object("Sale")) {
            $sales[] = $sale;
        }

        $con->close();

        // Return the valid sales, or null if none found
        return count($sales) > 0 ? $sales : null;
    }
}

?>