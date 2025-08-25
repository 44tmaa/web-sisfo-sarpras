@extends('layouts.app')

@section('content')
    <nav class="navbar mt-3 mb-4" style="background-color: #f8f9fa;">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Dashboard</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn" style="background-color: #dc3545; color: white;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card" style="background-color: #45b2f5; color: white;">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">{{ $userCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card" style="background-color: #488ddb; color: white;">
                <div class="card-body">
                    <h5 class="card-title">Barang</h5>
                    <p class="card-text">{{$barangCount}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card" style="background-color: #5a89f4; color: white;">
                <div class="card-body">
                    <h5 class="card-title">Kategori</h5>
                    <p class="card-text">{{$kategoriCount}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card" style="background-color: #5a89f4; color: white;">
                <div class="card-body">
                    <h5 class="card-title">Peminjaman</h5>
                    <p class="card-text">{{$peminjamanCount}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card" style="background-color: #5a89f4; color: white;">
                <div class="card-body">
                    <h5 class="card-title">Pengembalian</h5>
                    <p class="card-text">{{$pengembalianCount}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection