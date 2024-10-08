<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card for total number of users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold">Total Users</h3>
                        <p class="text-2xl">{{ $totalUsers }}</p>
                    </div>
                </div>

                <!-- Card for total number of shortened URLs -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold">Total Shortened URLs</h3>
                        <p class="text-2xl">{{ $totalShortenedUrl }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
