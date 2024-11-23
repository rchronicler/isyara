<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Submission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                        {{ __('Edit Submission Form') }}
                    </h2>
                    <form action="{{ route('submissions.update', $submission->entry_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Title Field -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $submission->title) }}" autocomplete="off"
                                       class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('title') border-red-500 @enderror">
                                @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" autocomplete="off"
                                          class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-500 @enderror">{{ old('description', $submission->description) }}</textarea>
                                @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Video Field -->
                            <div>
                                <label for="video" class="block text-sm font-medium text-gray-700">Video</label>
                                <input type="file" name="video" id="video" autocomplete="off" onchange="validateFileSize(this)"
                                       class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-2 border-dotted border-gray-300 rounded-md p-2 hover:border-blue-500 @error('video') border-red-500 @enderror"
                                       accept="video/*">
                                @error('video')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                @if($submission->video_url)
                                    <div class="mt-2 text-sm text-gray-600">
                                        <strong>Current Video:</strong> <a href="{{ asset($submission->video_url) }}" target="_blank" class="text-blue-500">View Current Video</a>
                                    </div>
                                @endif
                            </div>

                            <!-- Category selection -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category" id="category" autocomplete="off"
                                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('category') border-red-500 @enderror">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}"
                                            @selected(old('category', $submission->category_id) == $category->category_id)>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <!-- Accordion for category guide -->
                                <div class="mt-4">
                                    <button type="button" id="accordion-toggle" aria-expanded="false"
                                            class="w-full text-left p-4 bg-gray-100 border border-gray-300 rounded-md text-sm font-semibold text-gray-800 hover:bg-gray-200 focus:outline-none">
                                        Panduan dalam Memilih Kategori
                                        <span id="accordion-arrow" class="float-right"><i class='bx bxs-plus-square'></i></span> <!-- Arrow symbol -->
                                    </button>
                                    <div id="accordion-content" class="hidden mt-2 p-4 bg-gray-50 border border-gray-300 rounded-md">
                                        <ul class="list-disc pl-5 space-y-2 text-sm text-gray-600">
                                            <li><strong>Kata Benda:</strong> Pilih kategori ini untuk video yang memperlihatkan nama benda, seperti "meja", "kursi", atau "rumah".</li>
                                            <li><strong>Kata Kerja:</strong> Gunakan kategori ini untuk tindakan atau aktivitas, seperti "makan", "berlari", atau "menulis".</li>
                                            <li><strong>Kata Sifat:</strong> Cocok untuk video yang menggambarkan karakteristik, seperti "besar", "indah", atau "mudah".</li>
                                            <li><strong>Kata Keterangan:</strong> Pilih ini untuk video yang menunjukkan cara, waktu, atau tempat, seperti "segera", "di sini", atau "perlahan".</li>
                                            <li><strong>Kata Ganti:</strong> Gunakan kategori ini untuk kata pengganti, seperti "saya", "kamu", atau "mereka".</li>
                                            <li><strong>Kata Sambung:</strong> Cocok untuk video yang menjelaskan penghubung seperti "dan", "tetapi", atau "karena".</li>
                                            <li><strong>Kata Depan:</strong> Pilih kategori ini untuk kata seperti "di", "ke", atau "pada".</li>
                                            <li><strong>Kata Seru:</strong> Gunakan untuk ekspresi atau seruan seperti "wow", "aduh", atau "oh".</li>
                                            <li><strong>Istilah Khusus:</strong> Pilih ini jika video berisi istilah teknis atau bidang tertentu, seperti istilah medis atau teknologi.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Update Submission') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
