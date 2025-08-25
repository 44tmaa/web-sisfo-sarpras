<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
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
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create(){
        $barang = Barang::all();
        return view('peminjaman.create', compact('barang'));
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

        $peminjaman = Peminjaman::create([
            
            'nama_peminjam' => $request->nama_peminjam,
            'barang_id' => $request->barang_id,
            'kelas' => $request->kelas,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'waiting',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dibuat.');
    }

    /**
     * Tampilkan detail peminjaman tertentu.
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'barang'])->findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Update status atau data peminjaman.
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        $barang = Barang::find($peminjaman->barang_id);
        if ($barang && $barang->stock > 0) {
            $barang->stock -= 1;
            $barang->save();
        }

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman diperbarui.');
    }

    public function kembalikanbarang($id){
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();

        $barang = Barang::find($peminjaman->barang_id);
        if ($barang && $barang->stock > 0) {
            $barang->stock += 1;
            $barang->save();
        }

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman dikembalikan.');

    }

    public function formtolak($id){
        $peminjaman = Peminjaman::findOrFail($id);

        return view('peminjaman.alasan_ditolak', compact('peminjaman'));

    }

    public function tolakpeminjaman(Request $request, $id){
        $request->validate([
            'alasan_ditolak' => 'required|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->status = 'ditolak';
        $peminjaman->alasan_ditolak = $request->alasan_ditolak;
        $peminjaman->save();


        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman ditolak.');

    }

    

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman dihapus.');
    }
}
