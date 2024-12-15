<x-home>
    <section id="quiz-container" class="space-y-8">
        @foreach($quizzes as $index => $quiz)
            <div class="quiz-item" data-index="{{ $index }}" class="p-4 border rounded-md shadow-md">
                {{-- Youtube video of the quiz --}}
                <iframe src="{{ $quiz->question_url }}" class="rounded-md my-4 mx-auto w-full sm:w-[70%] h-[480px]" allow="autoplay;"></iframe>

                {{-- Answer Section --}}
                <div class="mt-4">
                    <label for="answer-{{ $index }}" class="block text-lg font-semibold mb-2">Pilih Jawaban:</label>
                    <select name="answer-{{ $index }}" id="answer-{{ $index }}" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($options as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
    </section>
</x-home>
