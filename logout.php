<?php
    include_once ('managers/SessionManager.php');
    SessionManager::start();
    SessionManager::clear();
    header("Location: index.php");