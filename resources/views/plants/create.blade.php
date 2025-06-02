<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Plant') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <form action="{{ route('plants.store') }}" method="POST">
                @csrf

                <!-- Plant Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Plant Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full" required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Water Requirement (number input) -->
                <div class="mb-4">
                    <label for="water_requirement" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Water Requirement</label>
                    <input type="number" name="water_requirement" id="water_requirement" class="mt-1 block w-full" required>
                    @error('water_requirement')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Temperature (number input) -->
                <div class="mb-4">
                    <label for="temperature" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Temperature</label>
                    <input type="number" name="temperature" id="temperature" class="mt-1 block w-full" required>
                    @error('temperature')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Planted Date -->
                <div class="mb-4">
                    <label for="planted_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Planted Date</label>
                    <input type="date" name="planted_date" id="planted_date" class="mt-1 block w-full" required>
                    @error('planted_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price (₱)</label>
                    <input type="number" step="0.01" name="price" id="price" class="mt-1 block w-full" required>
                    @error('price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                    Save Plant
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
