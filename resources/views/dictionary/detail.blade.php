<x-home>
    {{-- Hero Section --}}
    <section class="rounded-lg mt-2 bg-gradient-to-r from-teal-600 to-teal-800 text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
                    Detail Kata ISYARA
                </h1>
                <a href="{{ url('/dictionary') }}"
                   class="bg-white text-teal-800 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-300 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Pencarian
                </a>
            </div>
        </div>
    </section>
    {{-- Main Content --}}
    <section class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-3xl mx-auto">
            {{-- Video Section --}}
            <div class="relative aspect-video">
                <iframe
                    class="absolute inset-0 w-full h-full"
                    src="{{ $submission->video_url }}"
                    title="{{ $submission->title }}"
                    frameborder="0"
                    allowfullscreen></iframe>
            </div>
            {{-- Content Section --}}
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl sm:text-3xl font-bold text-teal-800">
                        {{ $submission->title }}
                    </h2>
                    <button
                        type="button"
                        class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition"
                        onclick="saveWord({{ $submission->entry_id }})">
                        Simpan
                    </button>
                </div>
                <span class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-sm inline-block mb-4">
                {{ $submission->category->category_name }}
            </span>
                <div class="prose max-w-none">
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h3 class="text-lg font-semibold text-teal-800 mb-2">Deskripsi</h3>
                        <p class="text-gray-600">
                            {{ $submission->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function saveWord(entryId) {
            fetch(`/save-word`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({entry_id: entryId})
            })
                .then(response => {
                    if (response.ok) {
                        alert('Kata berhasil disimpan!');
                    } else {
                        alert('Gagal menyimpan kata.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Coba lagi.');
                });
        }
    </script>
</x-home>
