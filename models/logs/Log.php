<?php

class Log {
    private $id_log;
    private $datetime;
    private $user;
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
     * Get the value of datetime
     */ 
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set the value of datetime
     *
     * @return  self
     */ 
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

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
}