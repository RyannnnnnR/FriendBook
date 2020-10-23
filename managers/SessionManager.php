<?php


class SessionManager
{
    public static function start() {
        session_start();
    }
    public static function getAuthenticatedUser() {
        if(!isset($_SESSION['user'])) $_SESSION['user'] = -1;
        return $_SESSION['user'];
    }
    public static function setAuthenticatedUser($user_id) {
        $_SESSION['user'] = $user_id;
    }

    public static function isAuthenticatedUser() {
        return self::getAuthenticatedUser() != -1;
    }
    public static function clear() {
        session_unset();
        session_destroy();
    }

    public static function isStateSet() {
        return $_SESSION['state'] == true;
    }
    public static function getState()  {
        if(!isset($_SESSION['state'])) $_SESSION['state'] = false;
        return $_SESSION['state'];
    }
    public static function setState($state) {
        $_SESSION['state'] = $state;
    }
}