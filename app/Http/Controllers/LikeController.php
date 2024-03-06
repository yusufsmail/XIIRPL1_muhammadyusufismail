<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LikeFoto;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request,){
        $data=[
            'foto_id'=>$request->input('foto_id'),
            'user_id'=>$request->input('user_id'),
        ];
        LikeFoto::create($data);
        return back()->with('success', 'New Foto has been added');
    }

    public function dislike($id){
        LikeFoto::destroy($id);
        return back()->with('success', 'New Foto has been added');
    }
    
}
