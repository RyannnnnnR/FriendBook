<?php

    include('managers/UserManager.php');
    include('helpers/QueryBuilder.php');
    include('managers/SessionManager.php');
    if(isset($_GET['method'])) {
        $method = $_GET['method'];
        $manager = new UserManager();
        SessionManager::start();
        if($method == 'login') {
            if(isset($_POST['email']) && isset($_POST['password']))  {
                $email = trim($_POST['email']);
                $pass = trim($_POST['password']);
                $user = $manager->findUserByEmail($email, $pass);
                if ($user === null) {
                    header('Location: login.php?error=Invalid username or password');
                    return;
                }
                SessionManager::setAuthenticatedUser($user->getId());
                header('Location: profile.php?action=my_friends');
            }
        } else {
            //sign up
            if(isset($_POST['email']) && isset($_POST['displayName'])  && isset($_POST['password'])  && isset($_POST['confirm'])) {
                $email = trim($_POST['email']);
                $displayName = trim($_POST['displayName']);
                $pass = trim($_POST['password']);
                $confirm = trim($_POST['confirm']);
                $emails = array_column(QueryBuilder::table('friends')->select(['friend_email'])->get(),  'friend_email');
                $errors = [];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['invalidemail'] = 1;
                }
                if (in_array($email, $emails))  {
                   $errors['inuse'] = 1;
                }
                if(empty($displayName) || !preg_match('/^[a-zA-Z]+$/', $displayName)) {
                    $errors['invaliddisplay'] = 1;
                }
                if(!preg_match('/^[a-z0-9]+$/i', $pass) || $pass !== $confirm){
                    $errors['invalidpassword'] = 1;
                }
                if(count($errors) > 0){
                    $location = "?email=".urlencode($email)."&displayName=".urlencode($displayName) ."&".http_build_query($errors);
                    header('Location: index.php'.$location);
                    return;
                }
                $err = $manager->createUser($email, $displayName, $pass)->getErrors();
                $manager->refreshUsers();
                if (!$err) {
                    $user = $manager->findUserByEmail($email, $pass);
                    SessionManager::setAuthenticatedUser($user->getId());
                    header('Location: profile.php?action=add_friends');
                } else {
                    echo $err;
                }
            }
        }
    }