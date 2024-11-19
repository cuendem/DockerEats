<?php

include_once("models/User.php");
include_once("config/dataBase.php");

class UsersDAO {
    public static function getByEmail($email = '%') {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM USERS WHERE email LIKE ?');

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('s', $email);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($user = $result->fetch_object("User")) {
            $users[] = $user;
        }

        $con->close();

        return $users;
    }

    public static function getAll() {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM USERS');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($user = $result->fetch_object("User")) {
            $users[] = $user;
        }

        $con->close();

        return $users;
    }
}

?>