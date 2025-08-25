<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $barangCount = Barang::count();
        $kategoriCount = Kategori::count();
        $peminjamanCount = Peminjaman::count();
        $pengembalianCount = Pengembalian::count();
        
        

        return view('dashboard', compact('userCount','barangCount', 'kategoriCount', 'peminjamanCount', 'pengembalianCount'));
    }
}
