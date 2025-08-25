<?php

// app/Models/Barang.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['nama', 'kategori_id', 'stock', 'kondisi', 'gambar'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman(){
        return $this->hasMany(Peminjaman::class);
    }
}
