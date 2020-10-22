<?php
    if (isset($_GET['error'])){
        $error = $_GET['error'];
        $rediect = $_GET['redirect'];
?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
        <p class="font-bold">Something went wrong!</p>
        <p><?php echo $error ?></p>
        <p><?php echo $rediect!= null ? "Click <a href='profile.php?action=my_friends' class='underline font-semibold'>here</a> to go back to your profile": ""?></p>
    </div>
<?php } ?>