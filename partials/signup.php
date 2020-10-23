<?php
    $email = "";
    $displayName = "";
    $errors =  [];
    $errors['inuse'] = 0;
    $errors['invalidemail'] = 0;
    $errors['invalidpassword'] = 0;
    $errors['invaliddisplay'] = 0;
    if(isset($_GET['email']) && isset($_GET['displayName'])){
        $email = $_GET['email'];
        $displayName = $_GET['displayName'];
    }
    if  (isset($_GET['inuse'])){
        $errors['inuse'] = $_GET['inuse'];
    }
    if  (isset($_GET['invalidemail'])){
        $errors['invalidemail'] = $_GET['invalidemail'];
    }
    if  (isset($_GET['invalidpassword'])){
        $errors['invalidpassword'] = $_GET['invalidpassword'];
    }
    if  (isset($_GET['invaliddisplay'])){
        $errors['invaliddisplay'] = $_GET['invaliddisplay'];
    }
?>
<form action="authentication.php?method=sign_up" method="POST">
    <div class="flex flex-col mt-4">
        <label for="email" class="text-xs leading-5 text-gray-500">Email</label>
        <div class="mt-1">
            <div class="rounded-md shadow-sm w-full">
                <input type="text" name="email" id="email" class="w-full py-2 bg-white border rounded-md border-gray-400 sm:text-sm sm:leading-5 focus:outline-none pl-2" placeholder="tom.jones@gmail.com" value="<?php echo $email ?>"/>

            </div>
            <?php  if ($errors['invalidemail'] == 1) { ?> ?>
                <p class="text-red-500 text-sm">Invalid email provided</p>
            <?php } ?>
            <?php if ($errors['inuse'] == 1) {  ?>
                <p class="text-red-500 text-sm">Email already in use</p>
            <?php } ?>
        </div>
    </div>
    <div class="flex flex-col mt-4">
        <label for="displayName" class="text-xs leading-5 text-gray-500">Display Name</label>
        <div class="mt-1">
            <div class="rounded-md shadow-sm w-full">
                <input type="text" name="displayName" id="displayName" class="w-full py-2 bg-white border rounded-md border-gray-400 sm:text-sm sm:leading-5 focus:outline-none pl-2" placeholder="Tom Dingo" value="<?php echo $displayName ?>"/>

            </div>
            <?php if ($errors['invaliddisplay'] == 1)  { ?>
                <p class="text-red-500 text-sm">Display name is blank or contains invalid characters</p>
            <?php } ?>
        </div>
    </div>
    <div class="flex flex-col mt-4">
        <label for="password" class="text-xs leading-5 text-gray-500">Password</label>
        <div class="mt-1">
            <div class="rounded-md shadow-sm w-full">
                <input type="password" name="password" id="password" class="w-full py-2 bg-white border rounded-md border-gray-400 sm:text-sm sm:leading-5 focus:outline-none pl-2" placeholder="Password"/>

            </div>
            <?php if ($errors['invalidpassword'] == 1) { ?>
                <p class="text-red-500 text-sm">Password contained invalid characters or the passwords didn't match!</p>
            <?php } ?>
        </div>
    </div>
    <div class="flex flex-col mt-4">
        <label for="confirm" class="text-xs leading-5 text-gray-500">Confirm</label>
        <div class="mt-1">
            <div class="rounded-md shadow-sm w-full">
                <input type="password" name="confirm" id="confirm" class="w-full py-2 bg-white border rounded-md border-gray-400 sm:text-sm sm:leading-5 focus:outline-none pl-2" placeholder="Confirm"/>
            </div>
        </div>
    </div>
    <button type="submit" class="hover:bg-blue-800 hover:border-blue-800 border border-blue-700 mt-6 block text-white w-full bg-blue-700 rounded-md py-2 mt-1 cursor-pointer focus:outline-none text-center">Sign up</button>
</form>