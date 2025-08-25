<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan daftar semua peminjaman.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'barang'])->latest()->get();
        return response()->json([
            'success' => true,
            'data' => $peminjaman
        ]);
    }

    /**
     * Tampilkan form untuk membuat peminjaman baru.
     */
    public function create()
    {
        $barang = Barang::all();
        return response()->json([
            'success' => true,
            'data' => $barang
        ]);
    }

    /**
     * Simpan data peminjaman baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'barang_id' => 'required|exists:barangs,id',
            'kelas' => 'required|string|max:50',
            'tanggal_pinjam' => 'required|date',
        ]);

        $user = Auth::user();

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'nama_peminjam' => $request->nama_peminjam,
            'barang_id' => $request->barang_id,
            'kelas' => $request->kelas,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'waiting',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil dibuat.',
            'data' => $peminjaman
        ], 201);
    }

    /**
     * Tampilkan detail peminjaman tertentu.
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'barang'])->find($id);
        
        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $peminjaman
        ]);
    }

    /**
     * Update status peminjaman menjadi 'dipinjam'.
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan.'
            ], 404);
        }

        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        $barang = Barang::find($peminjaman->barang_id);
        if ($barang && $barang->stock > 0) {
            $barang->stock -= 1;
            $barang->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Data peminjaman diperbarui.',
            'data' => $peminjaman
        ]);
    }

    /**
     * Kembalikan barang (update status menjadi 'dikembalikan').
     */
    public function kembalikanbarang(Request $request, $id)
    {   
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamen,id',
            'kondisi' => 'required|string|max:255',
            'tanggal_dikembalikan' => 'required|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        
        $pengembalianData = [
            'peminjaman_id' => $request->peminjaman_id,
            'kondisi' => $request->kondisi,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
        ];

        $existingPengembalian = Pengembalian::where('peminjaman_id', $peminjaman->id)->first();

        if ($existingPengembalian) {
            $existingPengembalian->update($pengembalianData);
        } else {
            Pengembalian::create($pengembalianData);
        }

        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();

        $barang = Barang::find($peminjaman->barang_id);
        if ($barang) {
            $barang->stock += 1;
            $barang->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Data peminjaman dikembalikan.',
            'data' => $peminjaman
        ]);
    }

    /**
     * Tolak peminjaman.
     */
    public function tolakpeminjaman(Request $request, $id)
    {
        $request->validate([
            'alasan_ditolak' => 'required|string',
        ]);

        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan.'
            ], 404);
        }

        $peminjaman->status = 'ditolak';
        $peminjaman->alasan_ditolak = $request->alasan_ditolak;
        $peminjaman->save();

        return response()->json([
            'success' => true,
            'message' => 'Data peminjaman ditolak.',
            'data' => $peminjaman
        ]);
    }

    /**
     * Hapus data peminjaman.
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan.'
            ], 404);
        }

        $peminjaman->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data peminjaman dihapus.'
        ]);
    }

    public function riwayatpeminjaman(){
        $user = Auth::user();
        $peminjamen = Peminjaman::where('user_id', $user->id)->with('barang', 'user')->get();
        return response()->json($peminjamen);
    }
}