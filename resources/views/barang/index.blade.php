@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <nav class="navbar mt-3 mb-4" style="background-color: #f8f9fa;">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">Barang List</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="background-color: #f12c3f; color: white; border: none; padding: 6px 12px; border-radius: 4px;">Logout</button>
                        </form>
                    </div>
                </nav>

        <div class="d-flex justify-content-end mb-3">
            <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('barang.create') }}" style="background-color: #2f50e3; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none;">+ Create Barang</a>
            </div>
        </div>

        @if(session('success'))
            <div style="color: green; margin-bottom: 12px;">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
        <div class="card-header" style="background-color: #e6f0ff;">
            <h5 class="mb-0">Barang List</h5>
        </div>
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr style="background-color: #cce5ff;">
                    <th>No</th>
                    <th>Image</th>
                    <th>Nama Barang</th>
                    <th>Stock</th>
                    <th>Kondisi</th>
                    <th>Kategori</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Tidak ada Foto"
                                style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 4px;">
                        </td>

                        <td>{{ $barang->nama }}</td>
                        <td>{{ $barang->stock }}</td>
                        <td>{{ $barang->kondisi }}</td>
                        <td>{{ $barang->kategori->nama }}</td>
                        <td>
                            <a href="{{ route('barang.edit', $barang->id) }}"
                               style="background-color: #eaf039; color: white; padding: 4px 8px; border-radius: 4px; text-decoration: none; font-size: 0.875rem;">Edit</a>

                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this kategori?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background-color: #f12c3f; color: white; border: none; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    </div>
    @endsection
