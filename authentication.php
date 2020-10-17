<?php

    include('helpers/UserManager.php');

    if(isset($_GET['method'])) {
        $method = $_GET['method'];
        if($method == 'login') {
            if(isset($_POST['email']) && isset($_POST['password']))  {
                $email = trim($_POST['email']);
                $pass = trim($_POST['password']);
                $manager = new UserManager();
                echo $manager->findUser($email, $pass);

            }
        } else {
            //sign up
        }
    }