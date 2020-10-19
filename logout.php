<?php
    include_once ('managers/SessionManager.php');
    SessionManager::clear();
    header("Location: index.php");