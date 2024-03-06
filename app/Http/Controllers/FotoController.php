<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('foto.gallery',[
            'fotos'=>Foto::where('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('foto.create',[
            'fotos'=>Foto::get(),
            'album'=>Album::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validatedData= $request->validate([
    //         'judul_foto' => 'required',
    //         'deskripsi_foto' => 'required|max:255',
    //         'user_id' => 'required',
    //         'album_id' => 'required',
    //         'images' => 'image|file',
    //     ]);

    //     dd($validatedData);

    //     if($request->file('images')){
    //         $validatedData['images'] = $request->file('images')->store('post-images-foto');
    //     }

    //     Foto::create($validatedData);

    //     return redirect('/mygallery')->with('success', 'New Foto has been added');
    // }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'judul_foto' => 'required',
        'deskripsi_foto' => 'required|max:255',
        'user_id' => 'required',
        'album_id' => 'required',
        'images' => 'image|file|max:2000', // Sesuaikan ekstensi dan ukuran file
    ]);

    if ($request->hasFile('images')) {
        $imagePath = $request->file('images')->store('post-images-foto');
        $validatedData['images'] = $imagePath;
    }

    
    Foto::create($validatedData);

    return redirect('/mygallery')->with('success', 'New Foto has been added');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $komentar = Komentar::where('foto_id', $id)->get();
        $foto = Foto::with('user')->where('foto_id', $id)->findOrFail($id);
        return view('foto.show',[
            'foto'=>$foto,
            'komentar'=>$komentar
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foto = Foto::where('foto_id', $id)->findOrFail($id);
        $album = Album::get();
        return view('foto.edit',[
            'foto' => $foto,
            'album'=> $album
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $foto=Foto::where('foto_id', $id)->findOrFail($id);
        $rules = [
            'judul_foto' => 'required',
            'deskripsi_foto' => 'required|max:255',
            'images' => 'file|image|max:2000', // Sesuaikan batas ukuran dengan kebutuhan Anda
        ];

        $validatedData = $request->validate($rules);

                if($request->file('images')){
                    if($request->oldImage){
                        Storage::delete($request->oldImage);
                }
                $validatedData['images'] = $request->file('images')->store('post-images-foto');
            }

        Foto::where('foto_id', $foto->foto_id)->update($validatedData);
        
        return redirect('/mygallery')->with('success', 'Foto has been Updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto=Foto::where('foto_id', $id)->findOrFail($id);
        if($foto->images){
            Storage::delete($foto->images);
    }
        Foto::destroy($id);
        return redirect('/mygallery')->with('success', 'foto has been deleted');
    }
}
