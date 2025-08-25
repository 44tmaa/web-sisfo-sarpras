@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <nav class="navbar mt-3 mb-4" style="background-color: #f8f9fa;">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Peminjaman List</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background-color: #f12c3f; color: white; border: none; padding: 6px 12px; border-radius: 4px;">Logout</button>
            </form>
        </div>
    </nav>

    {{-- <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('peminjaman.create') }}" style="background-color: #2f50e3; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none;">+ Create Peminjaman</a>
    </div> --}}

    @if(session('success'))
        <div style="color: green; margin-bottom: 12px;">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header" style="background-color: #e6f0ff;">
            <h5 class="mb-0">Peminjaman List</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr style="background-color: #cce5ff;">
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Barang yang Dipinjam</th>
                        <th>Kelas</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $index => $peminjaman)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $peminjaman->nama_peminjam}}</td>
                            <td>{{ $peminjaman->barang->nama }}</td>
                            <td>{{ $peminjaman->kelas }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam}}</td>
                            <td>{{ $peminjaman->status }}</td>
                            <td>
                                @if ($peminjaman->status == 'waiting')
                                    <form action="{{route('peminjaman.update', $peminjaman->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to accept this peminjaman?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"style="background-color: #1313dc; color: white; border: none; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem; ">Accept</button>
                                </form>
                                <a href="{{route('peminjaman.ditolak', $peminjaman->id)}}" style="background-color: #dc2013; color: white; border: none; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem; text-decoration:none;">Tolak Peminjaman</a>
                                {{-- @elseif ($peminjaman->status == 'dipinjam')
                                    <form action="{{route('kembalikan.barang', $peminjaman->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to return this peminjaman?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"style="background-color: #1313dc; color: white; border: none; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem;">Return</button>
                                    </form> --}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
