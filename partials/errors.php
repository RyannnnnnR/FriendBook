<?php
    if (isset($_GET['error'])){
        $error = $_GET['error'];
?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
        <p class="font-bold">Something went wrong!</p>
        <p><?php echo $error ?></p>
    </div>
<?php } ?>