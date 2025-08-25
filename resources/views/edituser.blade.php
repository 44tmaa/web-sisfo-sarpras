<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit User</title>
</head>
<body style="background-color: #f9f9f9; font-family: Arial, sans-serif;">
<div style="width: 600px; margin: 50px auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; color: #333;">Edit User</h2>

    @if ($errors->any())
        <div style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('edit.user', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; font-weight: bold; margin-bottom: 5px; color: #555;">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; font-weight: bold; margin-bottom: 5px; color: #555;">
                Password <small style="font-weight: normal; color: #888;">(change your password)</small>
            </label>
            <input type="password" name="password" id="password" placeholder="New password"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit"
                style="background-color: #2f50e3; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
            Update User
        </button>
        <a href="{{ route('dashboard') }}"
           style="background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; margin-left: 10px;">
            Cancel
        </a>
    </form>
</div>
</body>
</html>
