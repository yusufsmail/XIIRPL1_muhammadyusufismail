<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$foto->judul_foto }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Container untuk foto dan deskripsi -->
                    <div class="flex flex-col items-center md:flex-col -mx-4">
                        <!-- Kolom untuk foto -->
                        <div class="w-full md:w-3/4 flex justify-center">
                            <a href="{{ url('/gallery/' . $foto->foto_id) }}">
                                <img class="w-full rounded-lg " src="{{ asset('storage/' . $foto->images) }}" alt="" style="max-height: 500px;">
                            </a>
                        </div>
                        <!-- Kolom untuk teks dan tombol -->
                        <div class="w-full md:w-3/4 pt-5 flex flex-col justify-center" style="max-width: 100%; word-wrap: break-word;">
                            <!-- Kolom untuk teks -->
                            <div class="flex flex-col justify-start">
                                <h1 class="text-2xl font-bold"> {{ $foto->judul_foto }}</h1>
                                <p class="mt-2 text-sm text-gray-900 dark:text-white">Creator: {{ $foto->user->name }}</p>
                                <p class="mt-2 text-sm text-gray-900 dark:text-gray">Created at: {{ $foto->tanggal_unggah }}</p>
                                <p class="mt-10">{{ $foto->deskripsi_foto }}</p>
                            </div>
                            <!-- Kolom untuk tombol edit dan delete -->
                            <div class="mt-auto flex justify-end">
                                <a href="/mygallery/{{$foto->foto_id}}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2">Edit</a>
                                <form action="{{route ('mygallery.delete', $foto->foto_id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded m-2">Delete</button>
                                </form>
                            </div>
                        <!-- Div untuk komentar -->
                        <div class="mt-4 w-full flex flex-col items-center justify-start">
                            <h2 class="text-xl font-bold">Comments:</h2>
                            <div class="">
                                @foreach($komentar as $k)
                                <article class="p-6 text-base bg-white dark:bg-gray-900 max-w-3xl" >
                                    <footer class="flex justify-between items-center mb-2">
                                        <div class="flex items-center">
                                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">{{$k->user->name}}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                                    title="February 8th, 2022">{{$k->tanggal_komentar}}</time></p>
                                        </div>
                                    </footer>
                                    <p class="text-gray-500 dark:text-gray-400" style="max-width: 100%; word-wrap: break-word;">{{$k->isi_komentar}}</p>
                                    <div class="flex items-center mt-4 space-x-4">
                                    <form action="{{route('komentar.delete', $k->komentar_id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                                            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l3-14"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
