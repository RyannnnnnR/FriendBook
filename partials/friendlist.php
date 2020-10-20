<?php
$manager = new FriendManager();
$page = 1;
if(isset($_GET['page']))
    $page = $_GET['page'];
?>
<div>
    <h2 class="text-2xl leading-5 my-6">My Friends</h2>
</div>
<div class="grid grid-flow-row grid-cols-3 gap-6 mt-6">
    <?php foreach ($manager->paginate($page, $manager->getFriends()) as $user) { ?>
        <div class="bg-gray-700 shadow overflow-hidden sm:rounded-lg">
        <div class="shadow-md h-full">
            <div class="p-6">
                <div class="flex  justify-between">
                    <div class="">
                        <h4 class="text-gray-400 inline"><?php echo $user->getDisplayName()?> </span></h4>
                        <p class="text-gray-200 text-sm"><?php echo $user->getEmail()?></p>
                    </div>
                    <div>
                        <img src="<?php echo $user->getAvatarUrl()?>" alt="" class="rounded-full h-12 w-12">
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