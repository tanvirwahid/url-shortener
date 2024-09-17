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
                        <input id='url_id' hidden value="{{ $url->id }}" />

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
                                    value="{{ $url['shortened_url']!== null ? $url['shortened_url'] : 'Waiting...' }}" readonly>
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
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.iife.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlId = "{{ $url->id }}";

            if (document.getElementById('shortened_url').value == 'Waiting...') {
                fetch(`short-url/${urlId}/generate`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: urlId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

                window.Pusher = Pusher;
                Pusher.logToConsole = true;

                const echo = new Echo({
                    broadcaster: 'pusher',
                    key: '{{ env("PUSHER_APP_KEY") }}',
                    cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
                    encrypted: true
                });

                echo.channel('url-shortened.' + urlId)
                    .listen('.urlId=' + urlId, (e) => {
                        document.getElementById('shortened_url').value = e.shortenedUrl;
                    });
            }

        });


        function copyToClipboard() {
            var urlInput = document.getElementById("shortened_url");

            urlInput.select();
            urlInput.setSelectionRange(0, 99999);

            document.execCommand("copy");

            alert("Copied the URL: " + urlInput.value);
        }
    </script>
</x-app-layout>
