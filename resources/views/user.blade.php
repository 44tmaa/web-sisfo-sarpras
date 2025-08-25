@extends('layouts.app')

@section('content')
                <nav class="navbar mt-3 mb-4" style="background-color: #f8f9fa;">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">User List</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="background-color: #f12c3f; color: white; border: none; padding: 6px 12px; border-radius: 4px;">Logout</button>
                        </form>
                    </div>
                </nav>

                <!-- Create User Button -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('createuser') }}" style="background-color: #2f50e3; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none;">+ Create User</a>
                </div>
                @if(session('success'))
                    <div style="color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- User List Table -->
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #e6f0ff;">
                        <h5 class="mb-0">User List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr style="background-color: #cce5ff;">
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->password }}</td>
                                        <td>
                                            <a href="{{ route('edit.user.form', $user->id) }}"
                                               style="background-color: #eaf039; color: white; padding: 4px 8px; border-radius: 4px; text-decoration: none; font-size: 0.875rem;">Edit</a>

                                            <form action="{{ route('delete.user', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this user?');">
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
</body>
</html>
