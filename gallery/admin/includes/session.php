<?php

class Session
{

    private $signedIn = false;
    public $userID;
    public $message;
    public $count;

    function __construct()
    {
        session_start();
        $this->checkLoginStatus();
        $this->visitorCount();
        $this->check_message();
    }

    public function visitorCount()
    {
        if(isset($_SESSION['count'])) {
            return $this->count = $_SESSION['count']++;
        } else {
            return $_SESSION['count'] = 1;
        }
    }

    private function checkLoginStatus()
    {
        if (isset($_SESSION['userID'])) {
            $this->userID = $_SESSION['userID'];
            $this->signedIn = true;
        } else {

            unset($this->userID);
            $this->signedIn = false;
        }
    }

    public function isUserSingedIn()
    {
        return $this->signedIn;
    }

    public function userLogin($user)
    {
        if ($user) {
            $this->userID = $_SESSION['userID'] = $user->id;
            $this->signedIn = true;
        }
    }

    public function userLogout()
    {
        unset($_SESSION['userID']);
        unset($this->userID);
    }

    public function message($msg = "")
    {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    private function check_message()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
}

$session = new Session();