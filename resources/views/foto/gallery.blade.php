<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Gallery') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex justify-between items-center">
                    <p class="text-gray-900 dark:text-gray-100">Your Gallery</p>
                    <p><a href="/mygallery/create" class="hover:text-blue-700 dark:hover:text-blue-300 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2">New Photos</a></p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($fotos as $f)
                    <div>
                        <a href="/mygallery/{{$f->foto_id}}"><img class="min-h-[70vh] max-h-[70vh] w-auto rounded-lg" src="{{asset('storage/'. $f->images)}}" alt=""></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
