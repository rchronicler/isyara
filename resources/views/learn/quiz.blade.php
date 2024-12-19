<x-home>
    <section id="quiz-container" class="max-w-4xl mx-auto px-4 py-8 space-y-12">
        <div class="quiz-item bg-white rounded-lg shadow-lg p-6">
            {{-- YouTube Video --}}
            <div class="aspect-video mb-8">
                <iframe
                    src="{{ $quiz->question_url }}"
                    class="w-full h-full rounded-lg shadow-md"
                    allow="autoplay"
                    frameborder="0"
                    allowfullscreen>
                </iframe>
            </div>

            {{-- Answer Section --}}
            <div class="mt-6 flex flex-col items-center">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Bahasa isyarat apakah yang ada di video?</h3>
                <div class="flex flex-wrap justify-center gap-4 max-w-3xl">
                    @foreach($quiz->options['options'] as $option)
                        <form class="inline-block answer-form" action="{{ route('check-answer') }}" method="post">
                            @csrf
                            <input type="hidden" name="quiz_id" value="{{ $quiz->quiz_id }}">
                            <input type="hidden" name="selected_answer" value="{{ $option }}">
                            <button
                                type="button"
                                class="answer-btn relative h-14 w-40 px-4 py-2 bg-white border-2 border-gray-200 rounded-xl hover:border-blue-500 focus:outline-none focus:border-blue-500 transition-all duration-200 ease-in-out group overflow-hidden flex items-center justify-center">
                                <div
                                    class="absolute inset-0 bg-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                <span class="relative text-base font-medium text-gray-700 group-hover:text-blue-600">
                                    {{ $option }}
                                </span>
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>

            {{-- Feedback Section --}}
            <div id="feedback-container" class="mt-6"></div>
        </div>

        {{-- Navigation Buttons --}}
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-lg p-4">
            <div class="max-w-4xl mx-auto flex justify-between items-center">
                <button type="button"
                        id="prevQuestion"
                        class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors disabled:opacity-50"
                    {{ $quiz->order == 1 ? 'disabled' : '' }}>
                    Previous
                </button>
                <div class="text-gray-600">
                    Question <span id="currentQuestion">{{ $quiz->order }}</span> of {{ count($quizzes) }}
                </div>
                <form action="{{ "/learn/" . $lesson_id . "/quiz/next" }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="order" value="{{ $quiz->order }}">
                    @if($quiz->order == count($quizzes))
                        <a href="/learn"
                           class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Finish
                        </a>
                    @else
                        <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Next
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </section>
</x-home>
