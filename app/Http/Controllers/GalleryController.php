<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\LikeFoto;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(){
        return view('index', [
            'gallery'=>Foto::latest()->filter(request(['search']))->get(),
        ]);
    }

    public function show($id){
        $komentar = Komentar::where('foto_id', $id)->get();
        $user_id = auth()->user()->id;
        $foto = Foto::with(['user'])->where('foto_id', $id)->findOrFail($id);
        $ceklike = LikeFoto::where('foto_id', $id)->where('user_id', $user_id)->first();
        return view('show',[
            'foto'=>$foto,
            'ceklike'=>$ceklike,
            'komentar'=>$komentar,
        ]);
    }
}
