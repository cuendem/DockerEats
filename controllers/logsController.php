<?php

include_once("models/logs/LogsDAO.php");

class logsController {
    public static function log($action) {
        if (isset($_SESSION['id_user'])) {
            $log = new Log();
            $log->setAction($action);
            $log->setId_user($_SESSION['id_user']);
            $log->setTimestamp(date("Y-m-d H:i:s"));
            LogsDAO::store($log);
        }
    }
}

?>