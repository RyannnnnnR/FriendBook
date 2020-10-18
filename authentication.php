<?php

    include('helpers/UserManager.php');
    include('helpers/SessionManager.php');
    if(isset($_GET['method'])) {
        $method = $_GET['method'];
        SessionManager::start();
        if($method == 'login') {
            if(isset($_POST['email']) && isset($_POST['password']))  {
                $email = trim($_POST['email']);
                $pass = trim($_POST['password']);
                $manager = new UserManager();
                SessionManager::setAuthenticatedUser($manager->findUser($email, $pass));
                header('Location: profile.php?action=my_friends');
            }
        } else {
            //sign up
        }
    }