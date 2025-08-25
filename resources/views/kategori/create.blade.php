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

    <form method="POST" action="{{ route('kategori.store') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama</label>
            <input type="text" name="nama" required value="{{ old('nama') }}"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit"
                style="background-color: #2f50e3; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            Simpan
        </button>
         <a href="{{ route('kategori.index') }}"
           style="background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; margin-left: 10px;">
            Cancel
        </a>
    </form>
</div>
</body>
</html>
