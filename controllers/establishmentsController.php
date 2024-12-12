<?php

include_once("models/establishments/EstablishmentsDAO.php");

class establishmentsController {
    public function index() {
        
    }

    public static function getEstablishment($id) {
        return EstablishmentsDAO::get($id);
    }
}

?>