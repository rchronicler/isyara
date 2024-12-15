<x-home>
    {{-- Hero --}}
    <section class="p-4 max-w-7xl mx-auto mt-16">
        <h1 class="text-center text-4xl font-bold">Pilih Topik untuk Hari ini!</h1>
        <p class="text-center text-lg mt-2">Temukan berbagai topik menarik dan pelajari bahasa isyarat dengan mudah. Mulailah perjalanan belajar Anda sekarang!
        </p>
    </section>

    {{-- Card Section --}}
    <section class="p-4 max-w-7xl mx-auto mt-12 mb-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($lessons as $lesson)
            <a href="{{ url('/learn/' . ($lesson->lesson_id)) }}" class="bg-gray-50 shadow-lg rounded-lg p-6 flex flex-col transition-transform hover:scale-105 focus:scale-105">
                <div class="w-16 h-16 bg-red-100 flex justify-center items-center rounded-full mb-4">
                    @if ($lesson->title == 'Abjad')
                        <i class="bx bxs-book text-red-500 text-3xl"></i>
                    @elseif ($lesson->title == 'Angka')
                        <i class="bx bx-calculator text-red-500 text-3xl"></i>
                    @elseif ($lesson->title == 'Sapaan')
                        <i class="bx bx-message text-red-500 text-3xl"></i>
                    @elseif ($lesson->title == 'Pekerjaan')
                        <i class="bx bxs-briefcase text-red-500 text-3xl"></i>
                    @elseif ($lesson->title == 'Waktu')
                        <i class="bx bx-time text-red-500 text-3xl"></i>
                    @elseif ($lesson->title == 'Keluarga')
                        <i class="bx bxs-user text-red-500 text-3xl"></i>
                    @endif
                </div>
                <h3 class="text-xl font-bold">{{ $lesson->title }}</h3>
                <p class="text-gray-500 mt-2">
                    Pelajari topik "{{ $lesson->title }}" untuk meningkatkan kemampuan bahasa isyarat Anda.
                </p>
            </a>
        @endforeach
    </section>
</x-home>
