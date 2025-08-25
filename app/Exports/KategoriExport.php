<?php

namespace App\Exports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KategoriExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kategori::all()->map(function ($kategori){
            return [
                $kategori->id,
                $kategori->nama
            ];
        });
    }
    public function headings(): array
    {
        return [
            'ID',
            'Name'
        ];
    }
}
