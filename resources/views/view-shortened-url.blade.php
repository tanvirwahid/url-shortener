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
                    <form method="POST" action="#">
                        @csrf <!-- This is important for Laravel's security -->

                        <div class="mb-4">
                            <label for="original_url" class="block text-sm font-medium text-gray-700">Original URL</label>
                            <input type="url" name="original_url" id="original_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $url['original_url'] }}"
                                   disabled>
                        </div>

                        <div class="mb-4">
                            <label for="original_url" class="block text-sm font-medium text-gray-700">Shortened URL</label>
                            <div class="mt-1 block w-full relative">

                                <input type="url" name="shortened_url" id="shortened_url"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm pr-12"
                                       value="{{ $url['url'] }}" readonly>
                                <button type="button" onclick="copyToClipboard()"
                                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-indigo-500 text-white px-3 py-1 rounded-md">
                                    Copy
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            var urlInput = document.getElementById("shortened_url");

            urlInput.select();
            urlInput.setSelectionRange(0, 99999);

            document.execCommand("copy");

            alert("Copied the URL: " + urlInput.value);
        }
    </script>
</x-app-layout>
