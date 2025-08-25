<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
</head>
<body style="background-color: #f9f9f9; font-family: Arial, sans-serif;">
<div style="width: 700px; margin: 50px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; color: #333;">Edit Barang</h2>

    @if ($errors->any())
        <div style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('barang.update', $barang) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Barang</label>
            <input type="text" name="nama" required value="{{ old('nama', $barang->nama) }}"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kategori</label>
            <select name="kategori_id" required
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kategori->id == $barang->kategori_id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Stock</label>
            <input type="number" name="stock" required value="{{ old('stock', $barang->stock) }}"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kondisi</label>
            <input type="text" name="kondisi" required value="{{ old('kondisi', $barang->kondisi) }}"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Gambar Baru</label>
            <input type="file" name="gambar"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        @if ($barang->gambar)
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Gambar Lama</label>
                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang"
                     style="max-width: 150px; max-height: 150px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
            </div>
        @endif

        <button type="submit"
                style="background-color: #2f50e3; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            Update
        </button>
        <a href="{{ route('barang.index') }}"
           style="background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; margin-left: 10px;">
            Cancel
        </a>
    </form>
</div>
</body>
</html>
