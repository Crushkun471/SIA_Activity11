<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end mb-4">
            <a href="{{ route('courses.create') }}"
               class="px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition text-sm">
                + Add Course
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-md">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr class="bg-gray-700 text-white text-left text-xs uppercase tracking-wider">
                        <th class="px-6 py-3">Subject</th>
                        <th class="px-6 py-3">Section</th>
                        <th class="px-6 py-3">Schedule / Room</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                        <tr class="border-t border-gray-700 hover:bg-gray-700">
                            <td class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $course->subject_title }}</td>
                            <td class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $course->section }}</td>
                            <td class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $course->schedule_room }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('courses.edit', $course) }}" class="px-2 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 transition text-xs">Edit</a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this course?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center px-6 py-4 text-gray-400">No courses available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
