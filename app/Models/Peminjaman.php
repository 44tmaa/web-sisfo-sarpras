<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
   use HasFactory;

    protected $table = 'peminjamen'; // karena bukan jamak standar (peminjamans)
    protected $fillable = ['user_id','nama_peminjam', 'barang_id', 'kelas', 'tanggal_pinjam', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pengembalian(){
        return $this->hasOne(Pengembalian::class);
    }
}
