<x-home>
    {{-- Hero Section --}}
    <section class="rounded-lg mt-2 bg-gradient-to-r from-teal-600 to-teal-800 text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
                    Kata Yang Disimpan
                </h1>
                <a href="{{ url('/dictionary') }}"
                   class="bg-white text-teal-800 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-300 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Pencarian
                </a>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="container mx-auto px-4 py-8">
        @if($savedWords->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($savedWords as $saved)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="relative aspect-video">
                            <iframe
                                class="absolute inset-0 w-full h-full"
                                src="{{ $saved->dictionary->video_url }}"
                                title="{{ $saved->dictionary->title }}"
                                frameborder="0"
                                allowfullscreen></iframe>
                        </div>
                        <div class="p-4">
                            <h2 class="text-xl font-bold text-teal-800 mb-2">
                                {{ $saved->dictionary->title }}
                            </h2>
                            <p class="text-sm text-gray-600 mb-3">
                                {{ $saved->dictionary->description }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-sm">
                                    {{ $saved->dictionary->category->category_name }}
                                </span>
                                <form action="{{ route('saved-words.destroy', $saved->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition-colors duration-300"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kata ini dari daftar simpanan?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <h3 class="text-xl text-gray-600 mb-2">Belum Ada Kata Yang Disimpan</h3>
                <p class="text-gray-500 mb-4">Mulai simpan kata-kata yang ingin Anda pelajari</p>
                <a href="{{ url('/dictionary') }}"
                   class="inline-block bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 transition duration-300">
                    Jelajahi Kata
                </a>
            </div>
        @endif
    </section>
</x-home>
