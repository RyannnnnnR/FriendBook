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
    <title>FriendBook - Profile</title>
</head>
<body class="bg-gray-800 text-white">
<div class="h-full">
    <?php include ('partials/navbar.php') ?>
    <div class="px-6">
        <?php
            $page = 1;
            if(isset($_GET['page']))
                $page = $_GET['page'];
            if (isset($_GET['action']) && !empty($_GET['action'])) {
                $action = $_GET['action'];
            } else {
                $_GET['error'] = "Cannot process action. Please press the back button to return to the previous page.";
                include ('partials/errors.php');
                return;
            }

        ?>
        <div class="flex items-center justify-center mt-6">
            <a href="profile.php?action=my_friends" class="px-3 py-2 mx-2 <?php echo $action == "my_friends" ? "bg-blue-200 text-blue-800 rounded-md font-medium" : ""?> text-sm">My Friends</a>
            <a href="profile.php?action=add_friends" class="px-3 py-2 mx-2 <?php echo $action == "add_friends" ? "bg-blue-200 text-blue-800 rounded-md font-medium" : ""?> text-sm">Add Friends</a>
        </div>
        <?php
            include_once ('managers/FriendManager.php');
            if($action == "my_friends") {
                include ("partials/friendlist.php");
            } else if ($action == 'add_friends') {
                include "partials/friendadd.php";
            }
        ?>
        <?php
        $manager = new FriendManager();
        if($manager->getPages($action == 'add_friends') > 0) { ?>
        <div class="flex justify-between w-full border-t border-gray-500 text-gray-200 mt-20">
            <a href="profile.php?action=<?php echo $action ?>&page=<?php echo $page-1?>" class="p-5">
                ← Previous
            </a>
            <ul class="relative inline-flex list-none">
                    <?php
                    for ($i = 1; $i  < $manager->getPages($action == 'add_friends') + 1; $i++) {
                        if ($i == $page) {
                            echo '<li class="relative block pt-5 px-5 border-t-2 border-blue-200 text-blue-200 -mt-px"><a href="#" class="block -mt-px">'. $i .'</a></li>';
                        } else {
                            echo '<li class="relative pt-5 px-5 -mt-px"><a href="profile.php?action='.$action.'&page='.$i.'"' . ' class="block mt-px">' . $i . '</a></li>';
                        }
                    }
                ?>
            </ul>
            <a href="profile.php?action=<?php echo $action ?>&page=<?php echo $page+1?> " class="p-5">
                Next →
            </a>
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
