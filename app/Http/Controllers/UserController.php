<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function index()
    {
        $users=User::all();
        return view('user',compact('users'));
    }

    public function create()
    {
        return view('createuser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => $request->password,
        ]);

        return redirect('/user')->with('success', 'User Added Successfully');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan nama dan password (plain text)
        $user = User::where('name', $request->name)
                    ->where('password', $request->password)
                    ->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Buat token jika login berhasil
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user

        ]);
    }

    public function logout(Request $request)
    {
        // Hapus token yang sedang digunakan
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }



    public function list()
    {
        $users = User::all();
        return view('user.data_user', compact('users'));
    }

    public function edit($id){
        $user = User::findorfail($id);
        return view('edituser', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input, misalnya hanya 'name' dan 'password' wajib diisi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|', // password boleh kosong (tidak diubah)
        ]);

        $user->name = $validated['name'];

        if (!empty($validated['password'])) {
            // Jika password diisi, update password (hash secara manual)
            $user->password = $validated['password'];
        }

        $user->save();

        return redirect()->route('user')->with('success', 'User updated successfully!');
    }
    public function destroy($id)
    {
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return redirect('/user')->with('success', 'User deleted successfully.');
    }

    return redirect('/user')->with('error', 'User not found.');
    }

    public function export(){
        return Excel::download(new UserExport, 'users.xlsx');
    }
}