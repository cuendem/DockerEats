<?php

include_once("models/offers/Offer.php");
include_once("config/dataBase.php");

class OffersDAO {
    public static function getAll() {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM OFFERS');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $offers = [];
        while ($offer = $result->fetch_object("Offer")) {
            $offers[] = $offer;
        }

        $con->close();

        return $offers;
    }

    public static function getAllAvailable($scope = '%') {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE and date validity checks
        $stmt = $con->prepare('SELECT * FROM OFFERS WHERE date_start <= CURDATE() AND (date_end IS NULL OR date_end >= CURDATE()) AND scope LIKE ?');

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('s', $scope);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $offers = [];
        while ($offer = $result->fetch_object("Offer")) {
            $offers[] = $offer;
        }

        $con->close();

        // Return the valid offers, or null if none found
        return count($offers) > 0 ? $offers : null;
    }
}

?>