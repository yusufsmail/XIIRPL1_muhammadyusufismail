<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';
    protected $primaryKey = 'foto_id';

    public function album(){
       return $this->belongsTo(Album::class, 'album_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function komentar(){
        return $this->hasMany(Komentar::class,'foto_id');
    }
    public function like(){
        return $this->hasMany(LikeFoto::class,'foto_id');
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('deskripsi_foto', 'like', '%' . $search . '%');
        });
        // $query->when($filters['judul'] ?? false, function($query, $judul) {
        //     return $query->where('judul_foto', 'like', '%' . $judul . '%');
        // });
    }

    protected $fillable = [
        'judul_foto',
        'deskripsi_foto',
        'images',
        'user_id',
        'album_id'
    ];

}
