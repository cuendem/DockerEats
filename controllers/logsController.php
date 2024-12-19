<?php

include_once("models/logs/LogsDAO.php");

class logsController {
    public static function log($action) {
        if (isset($_SESSION['id_user'])) {
            $log = new Log();
            $log->setAction($action);
            $log->setUser($_SESSION['id_user']);
            $log->setDatetime(date("Y-m-d H:i:s"));
            LogsDAO::store($log);
        }
    }
}

?>