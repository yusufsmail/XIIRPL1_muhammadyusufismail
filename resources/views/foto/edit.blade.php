<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Gallery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Create new Foto</p>
                </div>
                <div class="relative overflow-x-auto">
                    <form action="{{route('mygallery.update', $foto->foto_id)}}" method="post" class="max-w-sm mx-auto mb-10" enctype="multipart/form-data" >
                        @csrf
                        @method('put')
                        <div class="mb-5">
                            <label for="judul_foto" class="form-control block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" value="{{$foto->judul_foto}}" name="judul_foto" id="judul_foto" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required autofocus/>
                            @error('judul_foto')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="deskripsi_foto" class="form-control block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" value="{{$foto->deskripsi_foto}}" name="deskripsi_foto" id="deskripsi_foto" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                            @error('deskripsi_foto')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="images" class="form-label block mb-2 text-sm font-medium text-gray-900 dark:text-white">Images</label>
                            @if($foto->images)
                            <img src="{{asset('storage/'. $foto->images)}}"class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @else
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                            @endif
                            <input type="hidden" name="oldImage" value="{{ $foto->images }}">
                            <input class="form-control @error('images') is-invalid @enderror block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="images_help" type="file" id="images" name="images" onchange="previewImages()">
                            @error('images')
                            <div class="invalid-feedback">  {{$message}}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImages() {
        const images = document.querySelector('#images');
        const imgPreview = document.querySelector('.img-preview');
    
        imgPreview.style.display = 'block';
    
        const oFReader = new FileReader();
        oFReader.readAsDataURL(images.files[0]);
    
        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
      }
    </script>
</x-app-layout>

