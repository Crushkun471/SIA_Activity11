<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Customer') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('customers.update', $customer) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" name="name" value="{{ $customer->name }}"
                           class="mt-1 w-full rounded border-gray-300 dark:bg-whites-700 dark:text-dark" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                    <textarea name="address" class="mt-1 w-full rounded border-gray-300 dark:bg-white-700 dark:text-dark" required>{{ $customer->address }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                    <select name="gender" class="mt-1 w-full rounded border-gray-300 dark:bg-white-700 dark:text-dark" required>
                        <option value="Male" {{ $customer->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $customer->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                    <input type="date" name="dob" value="{{ $customer->dob }}"
                           class="mt-1 w-full rounded border-gray-300 dark:bg-white-700 dark:text-dark" required>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('customers.index') }}" class="text-sm text-gray-500 hover:underline">
                            Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
