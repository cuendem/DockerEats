<?php

include_once("models/logs/Log.php");
include_once("config/dataBase.php");

class LogsDAO {
    public static function getAll() {
        $con = DataBase::connect();

        // Prepare the SQL statement
        $stmt = $con->prepare('SELECT * FROM LOGS LOG BY id_log DESC');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $logs = [];
        while ($log = $result->fetch_object("Log")) {
            $logs[] = $log;
        }

        $con->close();

        return $logs;
    }

    public static function store($log) {
        $con = DataBase::connect();

        $datetime = $log->getDatetime();
        $user = $log->getUser();
        $action = $log->getAction();

        // Prepare the SQL statement
        $stmt = $con->prepare('INSERT INTO LOGS (datetime, user, action) VALUES (?, ?, ?)');

        // Bind the parameters
        $stmt->bind_param('sis', $datetime, $user, $action);

        // Execute the query
        $stmt->execute();

        $lastID = $con->insert_id;

        $con->close();

        return $lastID;
    }
}

?>