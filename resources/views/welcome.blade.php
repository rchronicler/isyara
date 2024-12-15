<x-home>
   <section class="max-w-7xl mx-auto py-10 flex items-center relative">
        <!-- Background Image for larger screens -->
        <div class="hidden sm:block w-2/3">
            <img src="{{ Storage::url('images/sign-language-pict.jpg') }}" alt="Sign Language"
                 class="w-full h-auto object-cover rounded-lg shadow-lg">
        </div>
        <!-- Overlay Text -->
        <div class="sm:absolute sm:top-1/2 sm:right-56 sm:transform sm:-translate-y-1/2 sm:translate-x-1/4 bg-teal-800 text-white p-6 rounded-lg shadow-lg max-w-sm h-[230px] mx-auto sm:mx-0">
            <h1 class="text-4xl font-bold mb-4">Website Pembelajaran Bahasa Isyarat</h1>
            <p class="text-sm">Pelajari bahasa isyarat Indonesia melalui video interaktif</p>
        </div>
    </section>
    <section class="max-w-7xl mx-auto py-10 sm:px-20">
        <div class="bg-teal-800 p-4 w-full rounded-lg">
            <div class="text-center text-white mb-8">
                <h2 class="font-bold text-4xl">
                    Pencarian Kata
                </h2>
                <p>Masukkan kata untuk mendapatkan bahasa isyaratnya!</p>
            </div>
            <div class="sm:max-w-[50%] mx-auto mb-8">
                <form action="{{ route('search') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="q" id="search"
                               class="w-full border-2 border-gray-300 p-2 pr-20 rounded-lg"
                               placeholder="Cari kata...">
                        <button type="submit"
                                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-teal-800 text-white px-4 py-1 rounded-lg">
                            Cari
                        </button>
                    </div>
                </form>
                <!-- Search Results -->
                <div id="results"
                     class="mt-2 absolute z-50 bg-white shadow-lg rounded-lg hidden p-4 overflow-y-auto max-h-[400px]"></div>
            </div>
        </div>
    </section>
    <section class="max-w-7xl mx-auto py-10">
        <div class="text-center">
            <h3 class="font-bold text-4xl text-teal-800">Mari Mulai Belajar!</h3>
            <p>Jelajahi berbagai topik menarik untuk belajar bahasa <br> isyarat, dari alfabet hingga ekspresi
                sehari-hari.</p>
        </div>
        <!-- carousel -->
        <div class="relative mt-8 overflow-hidden">
            <div class="pl-4 flex items-center">
                <!-- Left Scroll Button -->
                <button
                    id="scroll-left"
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-teal-800 text-white p-3 rounded-full shadow-lg z-10 hover:scale-110 hover:bg-teal-900 transition-transform duration-200"
                >
                    <i class='bx bxs-chevron-left'></i>
                </button>
                <div id="carousel" class="flex overflow-x-auto gap-6 pb-4 snap-x snap-mandatory no-scrollbar pr-4">
                    @foreach($categories as $category)
                        <a href="{{ url('/learn/categories/' . $category->category_id) }}"
                           class="flex-none w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] min-w-[280px] bg-gray-100 rounded-lg p-6 flex flex-col items-center snap-start transition-transform duration-200 hover:scale-105">
                            <div
                                class="w-full h-48 bg-gray-300 rounded-lg mb-4 flex items-center justify-center overflow-hidden">
                                <img src="{{ $category->img_url }}"
                                     class="w-full h-full object-cover"
                                     alt="{{ $category->category_name }}">
                            </div>
                            <h4 class="text-xl font-semibold text-gray-700 text-center">{{ $category->category_name }}</h4>
                            <p class="text-gray-600 text-center text-sm mt-2">{{ $category->description }}</p>
                        </a>
                    @endforeach
                </div>
                <!-- Right Scroll Button -->
                <button
                    id="scroll-right"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-teal-800 text-white p-3 rounded-full shadow-lg z-10 hover:scale-110 hover:bg-teal-900 transition-transform duration-200"
                >
                    <i class='bx bxs-chevron-right'></i>
                </button>
            </div>
        </div>
    </section>
</x-home>
