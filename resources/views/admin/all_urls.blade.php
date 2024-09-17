<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Urls') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Original URL</th>
                            <th class="px-4 py-2 border">Shortened URL</th>
                            <th class="px-4 py-2 border">Private</th>
                            <th class="px-4 py-2 border">Expires At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($urls as $url)
                            <tr>
                                <td class="px-4 py-2 border">{{ $url->id }}</td>
                                <td class="px-4 py-2 border">{{ $url->original_url }}</td>
                                <td class="px-4 py-2 border">{{ $url->url }}</td>
                                <td class="px-4 py-2 border">{{ $url->is_private ? 'yes' : 'no' }}</td>
                                <td class="px-4 py-2 border">{{ $url->expires_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $urls->links() }}
            </div>
        </div>
    </div>
</x-app-layout>