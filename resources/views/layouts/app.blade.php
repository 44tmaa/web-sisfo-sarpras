<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/custom-stripped-table.css">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #246aed;
        }
        .sidebar .nav-link {
            color: #ffffff;
        }
        .sidebar .nav-link:hover {
            background-color: #459de4;
        }
     .dropdown-menu {
        display: none;
        list-style: none;
        padding-left: 0;
        margin-top: 0.5rem;
        margin-left: 1rem;
        background-color: #63abea; /* Ubah warna latar dropdown */
        border-radius: 4px;
        overflow: hidden;
    }

    .dropdown.show .dropdown-menu {
        display: block;
    }

    /* Link di dalam dropdown */
    .dropdown-link {
        color: #ffffff; /* Warna teks */
        display: block;
        padding: 0.5rem 1rem;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .dropdown-link:hover {
        background-color: #286090; /* Warna saat hover */
    }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar py-3">
                <div class="position-sticky">
                    <h5 class="text-white px-3 mb-3">SISFO SARPRAS</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{route('user')}}">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{route('kategori.index')}}">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{route('barang.index')}}">Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{route('peminjaman.index')}}">Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{route('pengembalian.index')}}">Pengembalian</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link px-3" onclick="toggleDropdown(event)">Laporan ▼</a>
                            <ul class="dropdown-menu ps-3">
                                <li><a class="dropdown-link" href="{{route('user.export')}}">Laporan User</a></li>
                                <li><a class="dropdown-link" href="{{route('kategori.export')}}">Laporan Kategori</a></li>
                                <li><a class="dropdown-link" href="{{route('barang.export')}}">Laporan Barang</a></li>
                                <li><a class="dropdown-link" href="{{route('pengembalian.export')}}">Laporan Peminjaman</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleDropdown(event) {
            event.preventDefault();
            const li = event.target.closest('li');
            li.classList.toggle('show');
        }

        document.addEventListener('click', function(event) {
            const isClickInside = event.target.closest('.dropdown');
            if (!isClickInside) {
                document.querySelectorAll('.dropdown').forEach(function(dropdown) {
                    dropdown.classList.remove('show');
                });
            }
        });
    </script>

</body>
</html>