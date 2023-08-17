<?php

class DisclaimerOptions {

    private $id_disclaimer;
    private $message_disclaimer;
    private $redirection_ko;

    function __construct($id_disclaimer = "Nc", $message_disclaimer = "Nc", $rediction_ko = "Nc" ) {
    // function __construct() {
        $this->id_disclaimer = $id_disclaimer;
        $this->message_disclaimer = $message_disclaimer;
        $this->redirection_ko = $rediction_ko;
    }

    /**
     * Get the value of id_disclaimer
     */ 
    public function getId_disclaimer()
    {
        return $this->id_disclaimer;
    }

    /**
     * Set the value of id_disclaimer
     *
     * @return  self
     */ 
    public function setId_disclaimer($id_disclaimer)
    {
        $this->id_disclaimer = $id_disclaimer;

        return $this;
    }

    /**
     * Get the value of message_disclaimer
     */ 
    public function getMessage_disclaimer()
    {
        return $this->message_disclaimer;
    }

    /**
     * Set the value of message_disclaimer
     *
     * @return  self
     */ 
    public function setMessage_disclaimer($message_disclaimer)
    {
        $this->message_disclaimer = $message_disclaimer;

        return $this;
    }

    /**
     * Get the value of redirection_ko
     */ 
    public function getRedirection_ko()
    {
        return $this->redirection_ko;
    }

    /**
     * Set the value of redirection_ko
     *
     * @return  self
     */ 
    public function setRedirection_ko($redirection_ko)
    {
        $this->redirection_ko = $redirection_ko;

        return $this;
    }
}