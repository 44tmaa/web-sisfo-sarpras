<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of pengembalian.
     */
    public function index($id)
    {
        $peminjaman = Peminjaman::with(['user', 'barang', 'pengembalian'])
        ->where('id', $id)
        ->where('status', 'dikembalikan')
        ->first();

    if (!$peminjaman) {
        return response()->json([
            'success' => false,
            'message' => 'Data pengembalian tidak ditemukan.'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $peminjaman
    ]);

    }

    /**
     * Export data pengembalian to Excel.
     */
    public function export()
    {
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');
    }
}