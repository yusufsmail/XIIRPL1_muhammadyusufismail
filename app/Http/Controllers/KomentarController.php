<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request){
        $data=[
            'foto_id'=>$request->input('foto_id'),
            'user_id'=>$request->input('user_id'),
            'isi_komentar'=>$request->input('isi_komentar'),
        ];
        Komentar::create($data);
        return back()->with('success', 'New Foto has been added');
    }

    public function delete($id){
        Komentar::destroy($id);
        return back()->with('success', 'New Foto has been added');
    }
}
