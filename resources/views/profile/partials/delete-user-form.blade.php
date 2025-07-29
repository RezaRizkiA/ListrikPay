<button
    class="px-5 py-2 rounded-lg font-semibold text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 transition"
    x-data x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" type="button">
    {{ __('Delete Account') }}
</button>

<!-- Modal -->
<div x-data="{ open: false }" x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') open = true"
    x-on:keydown.escape.window="open = false" x-show="open"
    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-60" style="display: none;">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full p-6">
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.') }}
            </p>
            <div class="mt-6">
                <label for="delete_password"
                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-200">Password</label>
                <input id="delete_password" name="password" type="password"
                    class="block w-full p-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-red-500 focus:border-red-500 transition"
                    placeholder="{{ __('Password') }}">
                @if ($errors->userDeletion->has('password'))
                    <span class="text-xs text-red-500 mt-1">{{ $errors->userDeletion->first('password') }}</span>
                @endif
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button"
                    class="px-4 py-2 mr-2 rounded-lg font-semibold text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-700"
                    x-on:click="open = false">
                    {{ __('Cancel') }}
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded-lg font-semibold text-white bg-red-600 hover:bg-red-700">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </div>
</div>
