<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
</head>
<body style="background-color: #f9f9f9; font-family: Arial, sans-serif;">
<div style="width: 600px; margin: 50px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; color: #333;">Tambah Kategori Baru</h2>

    @if(session('success'))
        <div style="color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('peminjaman.store') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Peminjam</label>
            <input type="text" name="nama_peminjam" required value="{{ old('nama_peminjam') }}"
            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Barang</label>
            <select name="barang_id" required
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">-- Pilih Barang --</option>
                @foreach ($barang as $barang)
                    <option value="{{$barang->id}}">{{ $barang->nama }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kelas</label>
            <input type="text" name="kelas" required value="{{ old('kelas') }}"
            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_pinjam" required value="{{ old('tanggal_pinjam') }}"
            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit"
                style="background-color: #2f50e3; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            Simpan
        </button>
         <a href="{{ route('peminjaman.index') }}"
           style="background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; margin-left: 10px;">
            Cancel
        </a>
    </form>
</div>
</body>
</html>
