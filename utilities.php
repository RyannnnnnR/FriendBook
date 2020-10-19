<?php

include('helpers/FriendManager.php');
include('helpers/SessionManager.php');
if(isset($_GET['action'])) {
    $action = $_GET['action'];
    SessionManager::start();
    if($action == 'add' || $action == 'delete') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $manager = new FriendManager();
            $location = 'index.php';
            if ($action == 'add') {
                $manager->addFriend($id);
                $location = 'profile.php?action=add_friends';
            } else {
                $manager->removeFriend($id);
                $location = 'profile.php?action=my_friends';
            }
            header('Location: '.$location);
        }
    } else {
        echo "Unsupported operation";
    }
}
