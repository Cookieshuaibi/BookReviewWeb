<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return redirect(route('admin.roles.index'))->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->name = $request->name;
        $role->save();

        return redirect(route('admin.roles.index'))->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect(route('admin.roles.index'))->with('success', 'Role deleted successfully');
    }

    public function assign_users(Role $role)
    {
        $users = $role->users()->paginate(10);
        $user_count = $role->users()->count();
        return view('admin.roles.assign_users', compact('user_count','role','users'));
    }
}
