<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Course') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('courses.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject Title</label>
                    <input type="text" name="subject_title"
                           class="mt-1 w-full rounded border-gray-300 dark:bg-white-700 dark:text-white"
                           value="{{ old('subject_title') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Section</label>
                    <input type="text" name="section"
                           class="mt-1 w-full rounded border-gray-300 dark:bg-white-700 dark:text-white"
                           value="{{ old('section') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Schedule / Room</label>
                    <input type="text" name="schedule_room"
                           class="mt-1 w-full rounded border-gray-300 dark:bg-white-700 dark:text-white"
                           value="{{ old('schedule_room') }}" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Save Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
