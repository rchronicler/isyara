<x-home>
    {{-- Hero Search Section --}}
    <section class="rounded-lg mt-2 bg-gradient-to-r from-teal-600 to-teal-800 text-white py-8 sm:py-12 md:py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-center text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 sm:mb-5 md:mb-6 tracking-tight">
                Jelajah Kata ISYARA
            </h1>
            <p class="text-center text-base sm:text-lg md:text-xl mb-6 md:mb-8 max-w-2xl mx-auto text-white/90">
                Temukan dan eksplorasi berbagai kata dalam bahasa isyarat dengan mudah dan interaktif
            </p>

            {{-- Enhanced Search Bar --}}
            <form action="" method="GET" class="max-w-xl mx-auto">
                <div class="relative shadow-lg">
                    <input type="text" name="q" id="search"
                           class="w-full pl-10 pr-24 py-2 sm:py-3 border-0 rounded-lg text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-teal-500 transition duration-300"
                           placeholder="Cari kata atau kategori..." value="{{ request('q') }}">
                    <button type="submit"
                            class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-teal-500 hover:bg-teal-600 text-white px-4 sm:px-6 py-1 sm:py-2 rounded-lg transition duration-300 ease-in-out text-sm sm:text-base">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </section>

    {{-- Main Content Area --}}
    <section class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Spotlight Section (Left) --}}
            <div class="md:col-span-2">
                @if($submissions->count() > 0)
                    @php
                        $spotlightSubmission = $submissions->first();
                    @endphp
                    <div id="spotlight-submission" class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="relative aspect-video">
                            <iframe id="spotlight-iframe"
                                    class="absolute inset-0 w-full h-full"
                                    src="{{ $spotlightSubmission->video_url }}"
                                    title="{{ $spotlightSubmission->title }}"
                                    frameborder="0"
                                    allowfullscreen></iframe>
                        </div>
                        <div class="p-4 sm:p-6">
                            <h1 id="spotlight-title" class="text-2xl sm:text-3xl font-bold text-teal-800 mb-3">
                                {{ $spotlightSubmission->title }}
                            </h1>
                            <p id="spotlight-description" class="text-sm text-gray-600 mb-3">
                                {{ $spotlightSubmission->description }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span id="spotlight-category" class="bg-teal-100 text-teal-800 px-2 py-1 rounded-full">
                                    {{ $spotlightSubmission->category->category_name }}
                                </span>
                                <button type="button"
                                        id="spotlight-save-button"
                                        class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition"
                                        onclick="saveWord({{ $spotlightSubmission->entry_id }})">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-gray-100 p-6 rounded-xl text-center">
                        <h3 class="text-2xl text-gray-600 mb-3">Belum ada kata yang ditemukan</h3>
                        <a href="{{ route('submissions.create') }}"
                           class="inline-block bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition">
                            Tambah Kata Baru
                        </a>
                    </div>
                @endif
            </div>

            {{-- Submissions List (Right) --}}
            <div class="md:col-span-1">
                <h2 class="text-xl font-bold text-teal-800 mb-4">Daftar Kata</h2>
                @foreach($submissions->slice(1) as $submission)
                    <div
                        class="bg-white rounded-lg shadow-md p-4 mb-4 cursor-pointer hover:shadow-lg transition-all duration-300 submission-item"
                        data-video-url="{{ $submission->video_url }}"
                        data-title="{{ $submission->title }}"
                        data-description="{{ $submission->description }}"
                        data-category="{{ $submission->category->category_name }}"
                        data-id="{{ $submission->id }}">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-teal-800">{{ $submission->title }}</h3>
                                <span class="text-sm text-gray-500">{{ $submission->category->category_name }}</span>
                            </div>
                            <button type="button"
                                    class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition"
                                    onclick="event.stopPropagation(); saveWord({{ $submission->entry_id }})">
                                Simpan
                            </button>
                        </div>
                    </div>
                @endforeach
                @if($submissions->count() <= 1)
                    <div class="text-center text-sm text-gray-500 p-4 bg-gray-100 rounded-lg">
                        Tidak ada kata tambahan untuk ditampilkan
                    </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        function updateSpotlight(videoUrl, title, description, category, id) {
            // Update iframe source
            document.getElementById('spotlight-iframe').src = videoUrl;

            // Update title
            document.getElementById('spotlight-title').textContent = title;

            // Update description
            document.getElementById('spotlight-description').textContent = description;

            // Update category
            document.getElementById('spotlight-category').textContent = category;

            // Update save button
            document.getElementById('spotlight-save-button').onclick = function () {
                saveWord(id);
            };

            // Scroll to spotlight on mobile
            if (window.innerWidth < 768) {
                document.getElementById('spotlight-submission').scrollIntoView({behavior: 'smooth'});
            }
        }

        function saveWord(entryId) {
            fetch(`/save-word`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({entry_id: entryId})
            }).then(response => {
                if (response.ok) {
                    alert('Kata berhasil disimpan!');
                } else {
                    alert('Gagal menyimpan kata.');
                    console.log(response);
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Coba lagi.');
            });
        }
    </script>
</x-home>
