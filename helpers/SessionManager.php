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
    public static function clear() {
        session_unset();
        session_destroy();
    }
}