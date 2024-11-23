<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{--     White Card       --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Your Submissions') }}
                        </h2>
                        <a href="{{ route('submissions.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Create Submission') }}
                        </a>
                    </div>
                    <table class="min-w-full mt-4">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Title') }}
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Description') }}
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @if($submissions->isEmpty())
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap" colspan="3">
                                    <div class="text-sm leading-5 text-gray-500 text-center">
                                        {{ __('No submissions found.') }}
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach($submissions as $submission)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div
                                        class="text-sm leading-5 font-medium text-gray-900">{{ $submission->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">{{ $submission->description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    {{--                View                    --}}
                                    <a href="{{ route('submissions.show', $submission) }}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        <i class="bx bx-show text-xl"></i> <!-- View Icon -->
                                    </a>
                                    {{--                Edit                    --}}
                                    <a href="{{ route('submissions.edit', $submission) }}"
                                       class="text-yellow-600 hover:text-indigo-900">
                                        <i class="bx bx-edit text-xl"></i> <!-- Edit Icon -->
                                    </a>
                                    {{--                Delete                    --}}
                                    <form class="inline" action="{{ route('submissions.destroy', $submission) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Are you sure you want to delete this submission?')">
                                            <i class="bx bx-trash text-xl text-red-500"></i> <!-- Delete Icon -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
