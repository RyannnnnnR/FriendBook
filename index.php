<?php
    include_once ('managers/SessionManager.php');
    SessionManager::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendBook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-800">
    <div class="text-white">
    <?php
        include ('partials/navbar.php');
        include('helpers/Schema.php');
        include ('partials/errors.php');
        Schema::init();
    ?>
    </div>
<!--    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4">-->
<!--        <p class="font-bold">Success</p>-->
<!--        <p>Successfully created tables</p>-->
<!--    </div>-->
    <div class="flex mt-6">

        <div class="w-1/2 ml-6 mr-12">
        <main class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
            <div class="sm:text-center lg:text-left">
                <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-white sm:text-5xl sm:leading-none md:text-6xl">
                    Connect with friends
                    <br class="xl:hidden">
                    <span class="text-blue-200">around the world</span>
                </h2>
                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                    Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.
                </p>
                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                    <div class="rounded-md shadow">
                        <a href="about.php" class="w-full hover:text-gray-600 flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-white text-gray-900 focus:outline-none md:py-4 md:text-lg md:px-10">
                            About →
                        </a>
                    </div>
                </div>
            </div>
        </main>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-blue-200 cursor-pointer icon absolute bottom-0 left-0 mb-4 ml-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div id="info" class="absolute bottom-0 left-0 mt-2 mb-12 mr-4 w-1/3 rounded-md shadow-lg hidden">
                <div class="rounded-md bg-white shadow-xs p-4 ">
                    <h2 class="text-lg">Ryan Reichenberg (101106611)</h2>
                    <h3 class="text-xs">101106611@student.swin.edu.au</h3>
                    <p class="pt-4 text-sm">
                        I  declare  that  this  assignment  is  my  individual  work.  I  have  not  worked collaboratively nor have I copied from any other student’s work or from any other source.
                    </p>
                </div>
            </div>
            <div class="<?php echo (count(Schema::getErrors()) > 0 ? 'bg-red-300' : 'bg-green-300') ?> h-4 w-4 rounded-full absolute bottom-0 left-0 mb-5 ml-16 status-indicator cursor-pointer"></div>
            <div id="status" class="absolute bottom-0 left-0 mt-2 mb-12 mr-4 w-1/3 rounded-md shadow-lg hidden">
                <div class="rounded-md bg-white shadow-xs p-4 ">
                    <h2 class="text-lg"><?php echo count(Schema::getErrors()) > 0  ? "Error" : "Success"?></h2>
                    <h3 class="text-xs"><?php echo count(Schema::getErrors()) > 0  ? "Something went wrong!" : "Successfully executed queries"?></h3>
                    <?php if(count(Schema::getErrors()) > 0) { ?>
                        <ul class="p-4 list-disc text-sm">
                            <?php foreach (Schema::getErrors() as $error) {?>
                                <li><?php echo $error ?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="w-1/3">
            <div class="bg-white rounded-lg">
                <div class="p-8 pb-8">
                <div class="mt-2 mb-6">
                    <a href="login.php" class="hover:border-gray-600 hover:text-gray-600 block text-gray-800 w-full border border-gray-800 rounded-md py-2 mt-1 cursor-pointer focus:outline-none text-center">Log in</a>
                </div>
                <div class="mb-4">
                    <div class="border-b border-gray-500 text-center w-full mt-1 mx-0 mb-2" style="line-height: 0.1em;"><span class=" text-sm bg-white px-3 py-0 text-bg-700">OR</span></div>
                </div>
                <div>
                    <?php include('partials/signup.php') ?>
                </div>
                </div>
                <div class="bg-gray-200 border-t border-gray-500 rounded-b-lg  px-10 py-6">
                    <p class="text-xs text-gray-600 ">By signing up, you are agreeing to <b class="text-gray-900">Terms & Conditions</b>, as well as our <b class="text-gray-900">Data & Cookie policy</b>.</p>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
