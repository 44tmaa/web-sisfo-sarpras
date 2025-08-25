<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peminjaman::with(['user', 'barang'])
            ->where('status', 'dikembalikan')
            ->get()
            ->map(function ($peminjaman) {
                return [
                    $peminjaman->id,
                    $peminjaman->nama_peminjam,
                    $peminjaman->barang ? $peminjaman->barang->nama : null,
                    $peminjaman->kelas,
                    $peminjaman->tanggal_pinjam,
                    $peminjaman->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Peminjam',
            'Barang Yang Dipinjam',
            'Kelas',
            'Tanggal Peminjaman',
            'Status',
        ];
    }
}
