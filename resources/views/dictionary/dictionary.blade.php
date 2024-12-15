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
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.817A6 6 0 012 8z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
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
                        {{-- Spotlight Video --}}
                        <div class="relative aspect-video">
                            <iframe id="spotlight-iframe"
                                    class="absolute inset-0 w-full h-full"
                                    src="{{ $spotlightSubmission->video_url }}"
                                    title="{{ $spotlightSubmission->title }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>

                        {{-- Spotlight Details --}}
                        <div class="p-4 sm:p-6">
                            <h1 id="spotlight-title" class="text-2xl sm:text-3xl md:text-3xl font-bold text-teal-800 mb-3 sm:mb-4">
                                {{ $spotlightSubmission->title }}
                            </h1>
                            <p id="spotlight-description" class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">
                                {{ $spotlightSubmission->description }}
                            </p>

                            {{-- Metadata --}}
                            <div class="flex items-center justify-between text-xs sm:text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <span class="bg-teal-100 text-teal-800 px-2 py-1 rounded-full text-xs sm:text-sm">
                                        {{ $spotlightSubmission->category->category_name }}
                                    </span>
                                    <span class="text-gray-400">•</span>
                                    <span id="spotlight-user">{{ $spotlightSubmission->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Empty State for Spotlight --}}
                    <div class="bg-gray-100 p-6 sm:p-8 rounded-xl text-center">
                        <h3 class="text-2xl sm:text-3xl text-gray-600 mb-3 sm:mb-4">
                            Belum ada kata yang ditemukan
                        </h3>
                        <p class="text-sm sm:text-base text-gray-500 mb-4 sm:mb-6">
                            Mulailah dengan mencari kata atau mendaftarkan kata baru
                        </p>
                        <a href="{{ route('submissions.create') }}"
                           class="inline-block bg-teal-600 hover:bg-teal-700 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition duration-300 text-sm sm:text-base">
                            Tambah Kata Baru
                        </a>
                    </div>
                @endif
            </div>

            {{-- Submissions List (Right) --}}
            <div class="md:col-span-1">
                <div class="space-y-4">
                    <h2 class="text-xl sm:text-2xl font-bold text-teal-800 mb-3 sm:mb-4">Daftar Kata</h2>
                    @foreach($submissions->slice(1) as $submission)
                        <div
                            class="submission-item cursor-pointer bg-white rounded-lg shadow-md p-3 sm:p-4 hover:bg-teal-50 transition duration-300 group"
                            data-video-url="{{ $submission->video_url }}"
                            data-title="{{ $submission->title }}"
                            data-description="{{ $submission->description }}"
                            data-category="{{ $submission->category->category_name }}"
                            data-user="{{ $submission->user->name }}">
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-base sm:text-lg font-semibold text-teal-800 group-hover:text-teal-600 transition">
                                        {{ $submission->title }}
                                    </h3>
                                    <svg class="w-4 sm:w-5 h-4 sm:h-5 text-teal-500 opacity-0 group-hover:opacity-100 transition"
                                         fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex justify-between text-xs sm:text-sm text-gray-500">
                                    <span class="bg-teal-100 text-teal-800 px-2 py-1 rounded-full">
                                        {{ $submission->category->category_name }}
                                    </span>
                                    <span>{{ $submission->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if($submissions->count() <= 1)
                        <div class="text-center text-xs sm:text-sm text-gray-500 p-4 bg-gray-100 rounded-lg">
                            Tidak ada kata tambahan untuk ditampilkan
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-home>
