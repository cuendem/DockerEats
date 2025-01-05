<?php

include_once("models/users/User.php");
include_once("config/dataBase.php");

class UsersDAO {
    public static function getByEmail($email = '%') {
        $con = DataBase::getInstance(); // Reuse the singleton connection

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

        if (count($users) > 0) {
            return $users[0];
        } else {
            return null;
        }
    }

    public static function getById($id = '%') {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM USERS WHERE id_user LIKE ?');

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('i', $id);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($user = $result->fetch_object("User")) {
            $users[] = $user;
        }

        if (count($users) > 0) {
            return $users[0];
        } else {
            return null;
        }
    }

    public static function getAll() {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM USERS');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($user = $result->fetch_object("User")) {
            $users[] = $user;
        }

        return $users;
    }

    public static function store($user) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        $username = $user->getUsername();
        $password = $user->getPassword();
        $email = $user->getEmail();

        $stmt = $con->prepare('INSERT INTO USERS (username, password, email) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $username, $password, $email);

        $stmt->execute();

        $lastID = $con->insert_id;

        return $lastID;
    }

    public static function update($user) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        $username = $user->getUsername();
        $password = $user->getPassword();
        $id = $user->getId_user();

        $stmt = $con->prepare("UPDATE USERS SET username = ?, password = ? WHERE id_user = ?");
        $stmt->bind_param('ssi', $username, $password, $id);

        $stmt->execute();

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAmount() {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement
        $stmt = $con->prepare("SELECT COUNT(*) AS amount FROM USERS");
        $stmt->execute();
        $result = $stmt->get_result();

        $amount = $result->fetch_assoc()['amount'];

        return $amount;
    }
}

?>