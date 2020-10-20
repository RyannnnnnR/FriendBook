<?php
    $manager = new FriendManager();
    $page = 1;
    if(isset($_GET['page']))
        $page = $_GET['page'];
?>
<div>
    <h2 class="text-2xl leading-5 my-6">Add Friends</h2>
</div>
<div class="grid grid-flow-row grid-cols-3 gap-6 mt-6">
    <?php foreach ($manager->paginate($page, $manager->getAllUsers()) as $user) { ?>
    <div class="bg-gray-700 shadow overflow-hidden sm:rounded-lg">
        <div class="shadow-md h-full">
            <div class="p-6">
                <div class="flex  justify-between">
                    <div class="">
                        <h4 class="text-gray-400 inline"><?php echo $user->getDisplayName() ?><span class="bg-blue-200 inline-flex justify-between rounded-full px-2 text-xs text-blue-900 ml-2 leading-5 font-semibold"><?php echo $manager->getMutualFriendCount($user->getId())?><span class="font-normal ml-1"> Mutual Friends</span></span></h4>
                        <p class="text-gray-200 text-sm"><?php echo $user->getEmail() ?></p>
                    </div>
                    <div>
                        <img src="<?php echo $user->getAvatarUrl() ?>" alt="" class="rounded-full h-12 w-12">
                    </div>
                </div>
            </div>
            <div class="text-center border-t border-gray-500 text-gray-500 hover:text-gray-400">
                <a href="utilities.php?action=add&id=<?php echo $user->getId() ?>" class="w-full py-3 flex justify-center items-center"><svg class="w-6 h-6 text-gray-400 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg><span>Add Friend</span></a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>