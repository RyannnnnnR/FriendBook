<?php
include_once ('managers/SessionManager.php');
SessionManager::start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>FriendBook - My Friends</title>
</head>
<body class="bg-gray-800 text-white">
<div class="h-full">
    <?php include ('partials/navbar.php') ?>
    <div class="px-6">
        <?php
            if (isset($_GET['action']) && !empty($_GET['action'])) {
                $action = $_GET['action'];
            } else {
                echo "Cannot process page... Please return";
                return;
            }
        ?>
        <div class="flex items-center justify-center mt-6">
            <a href="profile.php?action=my_friends" class="px-3 py-2 mx-2 <?php echo $action == "my_friends" ? "bg-blue-200 text-blue-800 rounded-md font-medium" : ""?> text-sm">My Friends</a>
            <a href="profile.php?action=add_friends" class="px-3 py-2 mx-2 <?php echo $action == "add_friends" ? "bg-blue-200 text-blue-800 rounded-md font-medium" : ""?> text-sm">Add Friends</a>
        </div>
        <?php
            include_once ('managers/FriendManager.php');
            $manager = new FriendManager(SessionManager::getAuthenticatedUser());
            print_r($manager->findMutualFriends(19));
            if($action == "my_friends") {
                include "partials/friendlist.php";
            } else if ($action == 'add_friends') {
                include "partials/friendadd.php";
            }
        ?>
        <div class="flex justify-between w-full border-t border-gray-500 text-gray-200 mt-20">
            <a href="#" class="p-5">
                ← Previous
            </a>
            <ul class="relative inline-flex list-none">
                <li class="relative block pt-5 px-4 border-t-2 border-blue-200 text-blue-200 -mt-px"><a href="" class="block -mt-px">1</a></li>
                <li class="relative pt-5 px-5 -mt-px"><a href="" class="block mt-px">2</a></li>
                <li class="relative pt-5 px-5 -mt-px"><a href="" class="block mt-px">3</a></li>
                <li class="relative pt-5 px-5 -mt-px"><span class="block mt-px">...</span></li>
                <li class="relative pt-5 px-5 -mt-px"><a href="" class="block mt-px">8</a></li>
                <li class="relative pt-5 px-5 -mt-px"><a href="" class="block mt-px">9</a></li>
                <li class="relative pt-5 px-5 -mt-px"><a href="" class="block mt-px">10</a></li>
            </ul>
            <a href="#" class="p-5">
                Next →
            </a>
        </div>
    </div>
</div>
</body>
</html>
