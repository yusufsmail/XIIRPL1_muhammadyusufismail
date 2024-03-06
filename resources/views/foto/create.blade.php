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
                    <form action="/mygallery" method="post" class="max-w-sm mx-auto mb-10" enctype="multipart/form-data" >
                        @csrf
                        <div class="mb-5">
                            <label for="judul_foto" class="form-control block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="judul_foto" id="judul_foto" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required autofocus/>
                            @error('judul_foto')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="deskripsi_foto" class="form-control block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="deskripsi_foto" id="deskripsi_foto" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                            @error('deskripsi_foto')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label class="form-label block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="images">Upload file</label>
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                            <input name="images" accept="image/png, image/gif, image/jpeg, image/jpg" class="form-control @error('images') is-invalid @enderror block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="images_help" id="images" type="file" onchange="previewImages()">
                            @error('images')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="album_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album</label>
                            <select name="album_id" id="album_id" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($album as $a)
                                    @if(old('album_id') == $a->album_id)
                                        <option value="{{$a->album_id}}" selected>{{$a->nama_album}}</option>
                                    @else
                                        <option value="{{$a->album_id}}">{{$a->nama_album}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('album_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-400 text-sm ">Belum ada album? <a class="text-gray-500 hover:underline dark:text-gray-300 font-medium" href="{{route('album.create')}}">Buat Album</a></p>
                        </div>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
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
