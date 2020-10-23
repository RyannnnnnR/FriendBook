<?php
    $redirect = 0;
    if (isset($_GET['redirect'])) {
        $redirect = $_GET['redirect'];
    }
    if (isset($_GET['error'])){
        $error = $_GET['error'];
?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
        <p class="font-bold">Something went wrong!</p>
        <p><?php echo $error ?></p>
        <p><?php echo $redirect == 1 ? "Click <a href='profile.php?action=my_friends' class='underline font-semibold'>here</a> to go back to your profile": ""?></p>
    </div>
<?php } ?>