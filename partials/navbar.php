
<div class="nav w-full flex justify-between px-6 bg-gray-800">
    <a href="index.php" class="my-4"><img src="./styles/logo.svg" alt="logo"></a>
    <?php
        if (SessionManager::getAuthenticatedUser() !== -1) {
    ?>
        <div class="flex justify-center items-center">
            <a href="profile.php?action=my_friends" class="hover:bg-gray-600 mr-6 px-3 py-1 bg-gray-700 text-gray-200 rounded-md text-sm">My Profile</a>
            <a href="logout.php" class="hover:bg-gray-600 px-3 py-1 bg-gray-700 text-gray-200 rounded-md text-sm">Log out</a>
        </div>
    <?php } ?>
</div>