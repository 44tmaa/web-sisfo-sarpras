<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang::with('kategori')->get()->map(function ($barang){
            return [
                $barang->id,
                $barang->gambar,
                $barang->nama,
                $barang->stock,
                $barang->kondisi,
                $barang->kategori ? $barang->kategori->nama : null,
            ];
        });
    }
    public function headings() :array{
        return [
            'ID',
            'Image',
            'Nama Barang',
            'Stock',
            'Kondisi',
            'Kategori',
        ];
    }
}
