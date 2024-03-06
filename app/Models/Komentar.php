<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $primaryKey = 'komentar_id';
    public function foto(){
        return $this->belongsTo(Foto::class,'foto_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'foto_id',
        'isi_komentar'
    ];
}
