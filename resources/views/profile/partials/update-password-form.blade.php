<section class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow mb-8">
    <header>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
            {{ __('Update Password') }}
        </h2>
        <p class="mb-6 text-sm text-gray-600 dark:text-gray-300">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>
    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')
        <div>
            <label for="current_password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-200">Current Password</label>
            <input id="current_password" name="current_password" type="password"
                autocomplete="current-password"
                class="block w-full p-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500 transition">
            @if ($errors->updatePassword->has('current_password'))
                <span class="text-xs text-red-500 mt-1">{{ $errors->updatePassword->first('current_password') }}</span>
            @endif
        </div>
        <div>
            <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-200">New Password</label>
            <input id="password" name="password" type="password"
                autocomplete="new-password"
                class="block w-full p-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500 transition">
            @if ($errors->updatePassword->has('password'))
                <span class="text-xs text-red-500 mt-1">{{ $errors->updatePassword->first('password') }}</span>
            @endif
        </div>
        <div>
            <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-200">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password"
                class="block w-full p-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500 transition">
            @if ($errors->updatePassword->has('password_confirmation'))
                <span class="text-xs text-red-500 mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</span>
            @endif
        </div>
        <div>
            <button type="submit"
                class="px-5 py-2 rounded-lg font-semibold text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 transition">
                {{ __('Save') }}
            </button>
            @if (session('status') === 'password-updated')
                <span class="ml-3 text-green-600 dark:text-green-400 text-sm font-medium">{{ __('Saved.') }}</span>
            @endif
        </div>
    </form>
</section>
