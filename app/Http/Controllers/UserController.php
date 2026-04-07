<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        public function index()
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }
        
        // Get all users
        $users = User::all();
        
        return view('user', compact('users')); // Make sure this view exists
    }
    public function handle(Request $request, $userId = null)
    {
        if ($request->isMethod('get')) {
            // Menampilkan daftar user
            $users = User::all();
            return view('user', compact('users'));
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'role' => 'required|string|in:admin,petugas,user',
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);
    
            if ($user) {
                return back()->with('success', 'User berhasil ditambahkan. Role: ' . $user->role);
            } else {
                return back()->with('error', 'Terjadi kesalahan saat menambahkan user.');
            }
        }

        if ($request->isMethod('put') && $userId) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $userId,
                'password' => 'nullable|min:8|confirmed',
                'role' => 'required|string|in:admin,petugas,user',
            ]);

            $user = User::findOrFail($userId);

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->role = $request->role;

            if ($user->save()) {
                return back()->with('success', 'User berhasil diperbarui. Role baru: ' . $user->role);
            } else {
                return back()->with('error', 'Terjadi kesalahan saat memperbarui user.');
            }
        }

        if ($request->isMethod('delete') && $userId) {
            try {
                $user = User::findOrFail($userId);
                $user->delete();
                return back()->with('success', 'User berhasil dihapus.');
            } catch (\Exception $e) {
                return back()->with('error', 'Terjadi kesalahan saat menghapus user.');
            }
        }

        return back()->with('error', 'Aksi tidak diizinkan.');
    }
}