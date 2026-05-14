<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\User::latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10)->withQueryString();
        
        $totalUsers = \App\Models\User::count();
        $totalAdmins = \App\Models\User::where('is_admin', true)->count();

        return view('admin.users.index', compact('users', 'totalUsers', 'totalAdmins'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        
        $user = \App\Models\User::create($validated);
        
        \App\Models\ActivityLog::log('Tambah Pengguna', 'Manajemen Admin', "Menambahkan pengguna baru: {$user->email} (Admin: " . ($user->is_admin ? 'Ya' : 'Tidak') . ")");

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(\App\Models\User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $oldAdminStatus = $user->is_admin;
        $user->update($validated);
        
        $statusLog = $oldAdminStatus != $user->is_admin ? " (Status Admin berubah)" : "";
        \App\Models\ActivityLog::log('Update Pengguna', 'Manajemen Admin', "Memperbarui data pengguna: {$user->email}" . $statusLog);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(\App\Models\User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $email = $user->email;
        $user->delete();
        
        \App\Models\ActivityLog::log('Hapus Pengguna', 'Manajemen Admin', "Menghapus pengguna: {$email}");

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
