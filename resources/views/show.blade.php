<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $foto->judul_foto }}
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
                                <p class="mt-2 text-sm text-gray-900 dark:text-white">Creator: {{ $foto->user->name }}</p>
                                <p class="mt-2 text-sm text-gray-900 dark:text-gray">Created at: {{ $foto->tanggal_unggah }}</p>
                                <p class="mt-10">{{ $foto->deskripsi_foto }}</p>
                            </div>
                            <!-- Kolom untuk tombol edit dan delete -->
                            <div class="mt-auto flex justify-center">
                            @if(!$ceklike)
                            <form action="{{route('like',$foto->foto_id)}}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="foto_id" value="{{$foto->foto_id}}">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full flex items-center">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                                    </svg>
                                    Like
                                </button>
                            </form>
                            @else
                            <form action="{{route('dislike',$ceklike->like_id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full flex items-center">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 21.35l1.45-1.32C11.4 15.36 14 12.28 14 8.5 14 5.42 11.58 3 8.5 3S3 5.42 3 8.5C3 12.28 5.6 15.36 10.55 19.03L12 20.35 13.45 19.03C18.4 15.36 21 12.28 21 8.5 21 5.42 18.58 3 15.5 3 13.76 3 12.09 3.81 11 5.09 9.91 3.81 8.24 3 6.5 3 3.42 5.42 1 8.5 1h0c3.08 0 5.5-2.42 5.5-5.5 0-1.55-.64-2.95-1.68-3.95"></path>
                                    </svg>
                                    Dislike
                                </button>
                            </form>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 text-center"> {{$foto->like->count()}}</p>
                        </div>
                        <!-- Div untuk komentar -->
                        <div class="mt-4 w-full flex flex-col items-center justify-start">
                            <h2 class="text-xl font-bold">Comments: {{$komentar->count()}}</h2>
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
                                </article>
                                @endforeach
                                <form class="mb-6 p-5" action="{{route('komentar.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                    <input type="hidden" name="foto_id" value="{{$foto->foto_id}}">
                                    <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                        <label for="comment" class="sr-only">Your comment</label>
                                        <textarea id="comment" name="isi_komentar" rows="6"
                                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                            placeholder="Write a comment..." required></textarea>
                                    </div>
                                    <button type="submit"
                                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800 bg-blue-500 hover:bg-blue-700 text-white">
                                        Post comment
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
