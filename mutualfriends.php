<?php
include_once ('managers/SessionManager.php');
include_once ('managers/FriendManager.php');
include_once ('managers/UserManager.php');
SessionManager::start();
$manager = new FriendManager();
$umanager = new UserManager();
    $id = -1;
    $page = 1;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    if(isset($_GET['page'])){
        $id = $_GET['page'];
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>FriendBook - Mutual Friends</title>
</head>
<body class="bg-gray-800 text-white">
<div class="h-full">
    <?php
        include ('partials/navbar.php');
        if($manager->getMutualFriendCount($id) == 0) {
            $_GET['error'] = "You have no mutual friend with this user";
            $_GET['redirect'] = 1;
            include ('partials/errors.php');
            return;
        }
    ?>

    <div class="px-6">
        <div>
            <h2 class="text-2xl leading-5 my-6">Mutual Friends with <?php echo $umanager->findUserById($id)->getDisplayName() ?></h2>
        </div>
        <div class="grid grid-flow-row grid-cols-3 gap-6 mt-6">
            <?php foreach ($manager->paginate($page, $manager->getMutualFriends($id)) as $user) { ?>
                <div class="bg-gray-700 shadow overflow-hidden sm:rounded-lg">
                    <div class="shadow-md h-full">
                        <div class="p-6">
                            <div class="flex  justify-between">
                                <div class="">
                                    <h4 class="text-gray-400 inline"><?php echo $user->getDisplayName() ?></h4>
                                    <p class="text-gray-200 text-sm"><?php echo $user->getEmail() ?></p>
                                </div>
                                <div>
                                    <img src="<?php echo $user->getAvatarUrl() ?>" alt="" class="rounded-full h-12 w-12">
                                </div>
                            </div>
                        </div>
                        <div class="text-center border-t border-gray-500 text-gray-500 hover:text-gray-400">
                            <a href="utilities.php?action=remove&id=<?php echo $user->getId() ?>" class="w-full py-3 flex justify-center items-center"><svg class="w-6 h-6 text-gray-400 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path></svg><span>Remove Friend</span></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="flex justify-between w-full border-t border-gray-500 text-gray-200 mt-20">
            <a href="mutualfriends.php?id=<?php echo $id?>&page=<?php echo $page-1?>" class="p-5">
                ← Previous
            </a>
            <ul class="relative inline-flex list-none">
                <?php
                for ($i = 1; $i  < $manager->getMutualFriendPages($id) + 1; $i++) {
                    if ($i == $page) {
                        echo '<li class="relative block pt-5 px-5 border-t-2 border-blue-200 text-blue-200 -mt-px"><a href="#" class="block -mt-px">'. $i .'</a></li>';
                    } else {
                        echo '<li class="relative pt-5 px-5 -mt-px"><a href="mutualfriends.php?page='.$i.'"' . 'class="block mt-px">' . $i . '</a></li>';
                    }
                }
                ?>
            </ul>
            <a href="mutualfriends.php?&page=<?php echo $page+1?>" class="p-5">
                Next →
            </a>
        </div>
    </div>
</div>
</body>
</html>
