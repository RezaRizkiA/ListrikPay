<section class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow mb-8">
    <header>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
            {{ __('Profile Information') }}
        </h2>
        <p class="mb-6 text-sm text-gray-600 dark:text-gray-300">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-200">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                autocomplete="name"
                class="block w-full p-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500 transition">
            @error('name')
                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-200">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                autocomplete="username"
                class="block w-full p-2.5 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500 transition">
            @error('email')
                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit"
                class="px-5 py-2 rounded-lg font-semibold text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 transition">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</section>
