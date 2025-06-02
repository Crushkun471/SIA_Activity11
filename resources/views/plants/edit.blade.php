<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Plant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-md rounded-lg">
                <form method="POST" action="{{ route('plants.update', $plant) }}">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 mb-1" for="name">Plant Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $plant->name) }}"
                            class="w-full px-4 py-2 border rounded-md dark:bg-white-700 dark:text-dark" required>
                    </div>

                    {{-- Water Requirement --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 mb-1" for="water_requirement">Water Requirement (ml)</label>
                        <input type="number" id="water_requirement" name="water_requirement" value="{{ old('water_requirement', $plant->water_requirement) }}"
                            class="w-full px-4 py-2 border rounded-md dark:bg-white-700 dark:text-dark" required>
                    </div>

                    {{-- Temperature --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 mb-1" for="temperature">Temperature (°C)</label>
                        <input type="number" id="temperature" name="temperature" value="{{ old('temperature', $plant->temperature) }}"
                            class="w-full px-4 py-2 border rounded-md dark:bg-white-700 dark:text-dark" required>
                    </div>

                    {{-- Planted Date --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 mb-1" for="planted_date">Planted Date</label>
                        <input type="date" id="planted_date" name="planted_date" value="{{ old('planted_date', $plant->planted_date) }}"
                            class="w-full px-4 py-2 border rounded-md dark:bg-white-700 dark:text-dark" required>
                    </div>

                    {{-- Price --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-200 mb-1" for="price">Price (₱)</label>
                        <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $plant->price) }}"
                            class="w-full px-4 py-2 border rounded-md dark:bg-white-700 dark:text-dark" required>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('plants.index') }}" class="text-sm text-gray-500 hover:underline">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                            Update Plant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
