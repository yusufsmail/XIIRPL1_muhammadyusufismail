<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albums';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function foto(){
        return $this->hasMany(Foto::class, 'album_id');
    }

    public function countPhotos()
    {
        return $this->foto()->count();
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('nama_album', 'like', '%' . $search . '%');
        });
    }

    protected $primaryKey = 'album_id';
    protected $fillable = [
        'nama_album',
        'deskripsi',
        'user_id'
    ];
    
}
