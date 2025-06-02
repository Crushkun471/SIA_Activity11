<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Plants') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4">
            <form method="GET" action="{{ route('plants.index') }}" class="flex flex-wrap items-center @if(request('search')) gap-4 @else gap-2 @endif">
                <input type="text" name="search" placeholder="Search plants..." value="{{ request('search') }}"
                    class="px-3 py-2 rounded-md border dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none w-full sm:w-1/2 md:w-1/3 lg:w-1/4">

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                    Search
                </button>

                @if(request('search'))
                    <a href="{{ route('plants.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 text-sm">
                        Reset
                    </a>
                @endif

                <a href="{{ route('plants.exportPdf', ['search' => request('search')]) }}"
                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm ml-auto">
                    Export PDF
                </a>
            </form>
        </div>

        <div class="flex justify-end mb-4">
            <a href="{{ route('plants.create') }}"
               class="px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition text-sm">
                + Add Plant
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 w-full"> 
                @if($plants->count())
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 w-full">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Water Requirement</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Temperature (°C)</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Planted Date</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Price (₱)</th> <!-- ✅ New header -->
                                <th class="px-4 py-2 text-left-15 text-sm font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($plants as $plant)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $plant->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $plant->water_requirement }} ml</td>
                                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $plant->temperature }} °C</td>
                                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($plant->planted_date)->format('F d, Y') }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">₱{{ number_format($plant->price, 2) }}</td> <!-- ✅ New column for price -->
                                    <td class="px-4 py-2 space-x-2">
                                        <div class="flex justify-center">
                                            <a href="{{ route('plants.edit', $plant) }}"
                                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition text-xs">Edit</a>

                                            <form action="{{ route('plants.destroy', $plant) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition text-xs">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else
                    <p class="text-gray-500 dark:text-gray-400">No plants available.</p>
                @endif
            </div>
            <div class="mt-4">
            {{ $plants->withQueryString()->links() }}
        </div>
        </div>
    </div>
</x-app-layout>
