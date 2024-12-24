<?php

class Log {
    private $id_log;
    private $timestamp;
    private $id_user;
    private $action;

    public function __construct() {

    }

    /**
     * Get the value of id_log
     */ 
    public function getId_log()
    {
        return $this->id_log;
    }

    /**
     * Set the value of id_log
     *
     * @return  self
     */ 
    public function setId_log($id_log)
    {
        $this->id_log = $id_log;

        return $this;
    }

    /**
     * Get the value of action
     */ 
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return  self
     */ 
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the value of timestamp
     */ 
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     *
     * @return  self
     */ 
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }
}