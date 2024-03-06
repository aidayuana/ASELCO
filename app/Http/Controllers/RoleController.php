<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya super admin yang dapat mengakses controller ini
        $this->middleware('can:manage roles')->except(['show']);
    }

    /**
     * Menampilkan daftar semua role.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Menampilkan form untuk membuat role baru.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Menyimpan role baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    /**
     * Menampilkan satu role tertentu.
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Menampilkan form untuk mengedit role.
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Memperbarui role dalam database.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * Menghapus role dari database.
     */
    public function destroy(Role $role)
    {
        if ($role->delete()) {
            return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
        } else {
            return back()->with('error', 'Gagal menghapus role.');
        }
    }
}
