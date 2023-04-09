<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transzakt | Login</title>

  @vite('resources/js/assets/main.css')
</head>

<body style="background-image: url('/assets/imgs/login-background.jpg')" class="bg-cover">
  @if (session()->has('loginError'))
  <div class="w-full text-white bg-red-500">
    <div class="container flex items-center justify-between px-6 py-4 mx-auto">
      <div class="flex">
        <p class="mx-3">{{ session('loginError') }}</p>
      </div>
    </div>
  </div>
  @endif

  <section class="mt-12 max-w-md p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
    <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Reset Password</h2>

    <form method="post" action="/api/reset-password">
      <div class="grid grid-cols-1 gap-6 mt-4">
        <input type="hidden" name="otp" value="{{ request()->get('otp') }}" />
        <input type="hidden" name="user_id" value="{{ request()->get('user_id') }}" />

        <div>
          <label class="text-gray-700 dark:text-gray-200" for="password">Password</label>
          <input id="password" name="password" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
          @if ($errors->has('password'))
          <span class="text-xs text-red-500">Invalid password</span>
          @endif
        </div>

        <div>
          <label class="text-gray-700 dark:text-gray-200" for="confirmPassword">Confirm Password</label>
          <input id="confirmPassword" name="confirmPassword" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
          @if ($errors->has('password'))
          <span class="text-xs text-red-500">Invalid password</span>
          @endif
        </div>

        <div class="flex justify-end mt-6">
          <button class="w-full px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
            Reset
          </button>
        </div>
    </form>
  </section>
</body>

</html>
