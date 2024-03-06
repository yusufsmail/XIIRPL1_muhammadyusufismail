<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Album') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>{{$title->nama_album}}</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($fotos as $f)
                    <div>
                        <a href="/mygallery/{{$f->foto_id}}"><img class="h-auto max-w-full rounded-lg" src="{{asset('storage/'. $f->images)}}" alt=""></a>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
