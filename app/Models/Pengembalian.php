<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'kondisi',
        'tanggal_dikembalikan',
    ];

    public function peminjaman(){
        return $this->belongsTo(Peminjaman::class);
    }
}
