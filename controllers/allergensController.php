<?php

include_once("models/allergens/AllergensDAO.php");

class allergensController {
    public static function getIcon($id) {
        switch ($id) {
            case 1:
                # Gluten
                return '';
            case 2:
                # Crustaceans
                return '';
            case 3:
                # Eggs
                return '';
            case 4:
                # Fish
                return '';
            case 5:
                # Peanuts
                return '';
            case 6:
                # Soy
                return '';
            case 7:
                # Milk
                return '';
            case 8:
                # Nuts
                return '';
            case 9:
                # Celery
                return '';
            case 10:
                # Mustard
                return '';
            case 11:
                # Sesame
                return '';
            case 12:
                # Sulphites
                return '';
            case 13:
                # Lupin
                return '';
            case 14:
                # Molluscs
                return '';
            default:
                return 'No allergen found with that code';
        }
    }
}