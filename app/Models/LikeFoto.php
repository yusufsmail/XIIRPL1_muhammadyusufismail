<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeFoto extends Model
{
    use HasFactory;
    protected $table = 'like_fotos';
    protected $primaryKey = 'like_id';

    public function foto(){
        return $this->belongsTo(Foto::class,'foto_id');
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }

    // public function countLike(){
    //     return $this->count();
    // }

    protected $fillable =[
        'foto_id',
        'user_id'
    ];
}
