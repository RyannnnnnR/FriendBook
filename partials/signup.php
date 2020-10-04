<form action="authentication.php?auth_method=sign_up" method="POST">
    <div class="flex flex-col mt-4">
        <label for="posId" class="text-xs leading-5 text-gray-500">Email</label>
        <div class="mt-1">
            <div class="rounded-md shadow-sm w-full">
                <input type="text" name="posId" id="posId" class="w-full py-2 bg-white border rounded-md border-gray-400 sm:text-sm sm:leading-5 focus:outline-none pl-2" placeholder="tom.jones@gmail.com"/>
            </div>
        </div>
    </div>
    <div class="flex flex-col mt-4">
        <label for="posId" class="text-xs leading-5 text-gray-500">Display Name</label>
        <div class="mt-1">
            <div class="rounded-md shadow-sm w-full">
                <input type="text" name="posId" id="posId" class="w-full py-2 bg-white border rounded-md border-gray-400 sm:text-sm sm:leading-5 focus:outline-none pl-2" placeholder="Tom Dingo"/>
            </div>
        </div>
    </div>
    <div class="flex flex-col mt-4">
        <label for="posId" class="text-xs leading-5 text-gray-500">Password</label>
        <div class="mt-1">
            <div class="rounded-md shadow-sm w-full">
                <input type="password" name="posId" id="posId" class="w-full py-2 bg-white border rounded-md border-gray-400 sm:text-sm sm:leading-5 focus:outline-none pl-2" placeholder="Password"/>
            </div>
        </div>
    </div>
    <div class="flex flex-col mt-4">
        <label for="posId" class="text-xs leading-5 text-gray-500">Confirm</label>
        <div class="mt-1">
            <div class="rounded-md shadow-sm w-full">
                <input type="password" name="posId" id="posId" class="w-full py-2 bg-white border rounded-md border-gray-400 sm:text-sm sm:leading-5 focus:outline-none pl-2" placeholder="Confirm"/>
            </div>
        </div>
    </div>
    <button type="submit" class="hover:bg-blue-800 hover:border-blue-800 border border-blue-700 mt-6 block text-white w-full bg-blue-700 rounded-md py-2 mt-1 cursor-pointer focus:outline-none text-center">Sign up</button>
</form>