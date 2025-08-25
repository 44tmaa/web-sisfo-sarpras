<?php
// app/Http/Controllers/BarangController.php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'stock' => 'required',
            'kondisi' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('barang' , 'public');
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang Added Succesfully');
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'stock' => 'required',
            'kondisi' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::delete($barang->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('barang' , 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang Updated Succesfully ');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::delete($barang->gambar);
        }

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang Deleted Succesfully ');
    }
    
    public function export(){
        return Excel::download(new BarangExport, 'barang.xlsx');
    }
}
