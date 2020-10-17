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
        include ('helpers/Schema.php');
        Schema::init();
    ?>
    </div>
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
