<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('short-url.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="original_url" class="block text-sm font-medium text-gray-700">Original URL</label>
                            <input type="url" name="original_url" id="original_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('original_url') }}"
                                required placeholder="https://your-url">
                            @error('original_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @can('set-custom-url')
                        <div class="mb-4">
                            <label for="shortened_url" class="block text-sm font-medium text-gray-700">Shortened URL</label>

                            <div class="flex items-center space-x-4">
                                <div>{{ url('/') . '/' }}</div>
                                <input type="text" name="shortened_url" id="shortened_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('shortened_url') }}"
                                     placeholder="your-url">
                            </div>
                            @error('shortened_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endcan



                        @can('add-private-url')
                        <div class="mb-4">
                            <label for="is_private" class="inline-flex items-center">
                                <input type="checkbox" name="is_private" id="is_private" value="1" class="form-checkbox" {{ old('is_private') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">Make this URL private</span>
                            </label>
                            @error('is_private')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endcan

                        @can('set-expiry-date')
                        <div class="mb-4">
                            <label for="original_url" class="block text-sm font-medium text-gray-700">Expires after (in days)</label>
                            <input type="number" name="expiration" id="expiration" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('expiration') }}"
                                placeholder="Expiration between 1 and 90 days" min="1" max="90">
                            @error('expiration')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endcan

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Shorten URL') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>