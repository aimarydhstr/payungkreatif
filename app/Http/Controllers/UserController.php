<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar user.
     */
    public function index(Request $request)
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Simpan user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'username'              => 'required|string|max:100|unique:users,username',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'role'                  => 'required|string',
            'status'                => 'required|in:active,inactive',
        ]);

        User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'status'    => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat!');
    }

    /**
     * Update user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:100|unique:users,username,' . $user->id,
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role'      => 'required|string',
            'status'    => 'required|in:active,inactive',
            'password'  => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'role'      => $request->role,
            'status'    => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Hapus user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
