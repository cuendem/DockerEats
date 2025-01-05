<?php

class DataBase {
    private static $instance = null; // Store the single connection instance
    private $connection;

    private function __construct($host, $user, $pass, $db, $port) {
        $this->connection = new mysqli($host, $user, $pass, $db, $port);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public static function getInstance($host = 'localhost', $user = 'root', $pass = '1234', $db = 'dockereats', $port = 3308) {
        if (self::$instance === null) {
            self::$instance = new DataBase($host, $user, $pass, $db, $port);
        }
        return self::$instance->connection;
    }

    public static function closeConnection() {
        if (self::$instance !== null) {
            self::$instance->connection->close();
            self::$instance = null;
        }
    }
}

?>