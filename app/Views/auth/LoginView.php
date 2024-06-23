<div class="">
    <?php if (isset($_COOKIE["logout_message"])): ?>
    <div id="toast-success"
        class="flex items-center  mx-auto m-12 w-full max-w-xs p-4 mb-4 text-gray-500 bg-green-200 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal"> <?= $_COOKIE["logout_message"] ?></div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <?php setcookie("logout_message", "", time() - 3600, "/");
    endif; ?>
    <div
        class="shadow-2xl w-full lg:max-w-md p-4 mx-auto mt-36 bg-white border border-gray-200 rounded-lg sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">

        <form class="space-y-6" action="loginadmin" method="post">

            <h5 class="text-xl font-medium text-amber-700 dark:text-white text-center">Log In to Anasera Inventory</h5>
            <?php if (session()->getFlashdata("error")): ?>
            <div class="bg-red-500 text-white p-2 rounded text-center">
                <?= session()->getFlashdata("error") ?>
            </div>

            <?php endif; ?>
            <div>
                <label for="username"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" name="username" id="username" value="<?= session()->getFlashdata('username')?>"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="your username" />
            </div>
            <div>
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
            </div>
            <div class="flex items-start">
                <a href="#" class="ms-auto text-sm text-amber-600 hover:underline">Lost Password?</a>
            </div>
            <input type="submit" name="login" value="LOGIN"
                class="w-full text-white border-none transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-x-100 hover:shadow-amber-800 hover:shadow-lg duration-300 bg-amber-700 hover:bg-amber-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
        </form>
    </div>

</div>