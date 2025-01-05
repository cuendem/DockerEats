<?php

include_once("models/logs/Log.php");
include_once("config/dataBase.php");

class LogsDAO {
    public static function getAll() {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement
        $stmt = $con->prepare('SELECT * FROM LOGS LOG BY id_log DESC');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $logs = [];
        while ($log = $result->fetch_object("Log")) {
            $logs[] = $log;
        }

        return $logs;
    }

    public static function store($log) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        $timestamp = $log->getTimestamp();
        $id_user = $log->getId_user();
        $action = $log->getAction();

        // Prepare the SQL statement
        $stmt = $con->prepare('INSERT INTO LOGS (timestamp, id_user, action) VALUES (?, ?, ?)');

        // Bind the parameters
        $stmt->bind_param('sis', $timestamp, $id_user, $action);

        // Execute the query
        $stmt->execute();

        $lastID = $con->insert_id;

        return $lastID;
    }
}

?>