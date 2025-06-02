<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Search and Export PDF -->
        <div class="mb-4">
            <form method="GET" action="{{ route('customers.index') }}" class="flex flex-wrap items-center @if(request('search')) gap-4 @else gap-2 @endif">
                <input type="text" name="search" placeholder="Search customers..." value="{{ request('search') }}"
                    class="px-3 py-2 rounded-md border dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none w-full sm:w-1/2 md:w-1/3 lg:w-1/4">

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                    Search
                </button>

                @if(request('search'))
                    <a href="{{ route('customers.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 text-sm">
                        Reset
                    </a>
                @endif

                <a href="{{ route('customers.exportPdf', ['search' => request('search')]) }}"
                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm ml-auto">
                    Export PDF
                </a>
            </form>
        </div>


        <!-- Add Customer Button -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('customers.create') }}"
               class="px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition text-sm">
                + Add Customer
            </a>
        </div>

        <!-- Customers Table -->
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Name</th>
                        <th scope="col" class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Address</th>
                        <th scope="col" class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Gender</th>
                        <th scope="col" class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">DOB</th>
                        <th scope="col" class="px-4 py-2 text-left-15 text-sm font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($customers as $customer)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $customer->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $customer->address }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $customer->gender }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $customer->dob }}</td>
                            <td class="px-4 py-2 text-sm text-right space-x-1">
                                <div class="flex justify-center">
                                    <a href="{{ route('customers.edit', $customer) }}"
                                       class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition text-xs">Edit</a>

                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition text-xs">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if($customers->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-sm text-gray-500 text-center">No customers found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $customers->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
