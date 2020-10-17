<?php
    if(isset($_GET['method'])) {
        $method = $_GET['method'];
        if($method == 'login') {
            if(isset($_POST['email']) && isset($_POST['password']))  {
                $email = $_POST['email'];
                $pass = $_POST['password'];
            }
        } else {
            //sign up
        }
    }