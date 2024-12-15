<x-home>
    <section class="max-w-7xl mx-auto py-10 px-4">
        <div class="flex items-center justify-between mb-4">
            <a href="/learn" class="text-teal-600 font-semibold hover:text-teal-500">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>

        <div class="text-center">
            <h2 class="font-bold text-4xl">{{ $lesson->title }}</h2>
            <p class="text-gray-600 mt-2">{{ $lesson->description }}</p>
        </div>

        <!-- Lesson Materials -->
        <div class="mt-8">
            {{-- <h3 class="font-bold text-2xl mb-4">Materi</h3> --}}
            <ul class="space-y-4">
                @foreach ($lesson->lessonMaterials as $material)
                    <li class="bg-gray-100 p-4 rounded-lg shadow">
                        <h4 class="font-semibold text-xl">{{ $material->title }}</h4>
                        <p class="text-gray-600 mt-2">{{ $material->description }}</p>
                        @if ($material->content_url)
                            <div class="mt-4 flex justify-center">
                                <div class="w-full aspect-video">
                                    <iframe class="w-full h-full rounded-lg shadow-md"
                                        src="{{ $material->content_url }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Lesson Quizzes -->
        <div class="mt-8 text-center bg-[#FAF8F6] p-8 shadow-md">
            <h2 class="text-2xl font-bold">Uji Pemahaman Kamu!</h2>
            <p class="mb-8">Ikuti kuis interaktif dan lihat skor kemampuan bahasa isyaratmu!</p>
            <a href="{{ url('/learn/' . ($lesson->lesson_id) . '/quiz')}}" class="bg-teal-700 hover:bg-teal-500 text-white font-semibold py-2 px-4 rounded">
                Mulai Quiz
            </a>
        </div>
    </section>
</x-home>
