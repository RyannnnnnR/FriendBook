<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>FriendBook - Login</title>
</head>
<body class="bg-gray-800 h-screen">
    <div class="flex items-center justify-center pb-6 px-4 h-full">
        <div class="max-w-md w-full">
            <div>
                <a href="index.php"><img src="styles/logo.svg"  class="mx-auto h-16 w-auto"  alt="logo"></a>
                <h2 class="mt-10 text-2xl leading-9 font-extrabold text-white">
                    Login
                </h2>
            </div>
            <form action="authentication.php?method=login" class="mt-4" method="POST">
                <div class="rounded-md shadow-sm">
                    <div>
                        <input aria-label="Email address" name="email" type="email" required class="text-sm appearance-none rounded-none relative block w-full px-3 py-2 bg-gray-700 border border-transparent placeholder-gray-500 text-gray-300 rounded-t-md focus:outline-none focus:shadow-outline-red focus:border-blue-300 focus:z-20" placeholder="Email address">
                    </div>
                    <div class="-mt-px border-t relative border-gray-600 z-10">
                        <input aria-label="Password" name="password" type="password" required class="text-sm appearance-none relative rounded-none block w-full px-3 py-2 bg-gray-700 border border-transparent placeholder-gray-500 text-gray-300 rounded-b-md focus:outline-none focus:shadow-outline-red focus:border-blue-300 focus:z-20" placeholder="Password">
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-blue-900 bg-blue-300 hover:bg-blue-500 focus:outline-none focus:border-indigo-700 active:bg-indigo-700">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
