<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Օգտատերերի ցուցակ
    public function index()
    {
        $users = User::with('roles')->latest()->get();

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    // Օգտատիրոջ դերի փոփոխություն
    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $role = Role::findOrFail($validated['role_id']);

        // Փոխում ենք օգտատիրոջ դերը
        $user->roles()->sync([$role->id]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Օգտատիրոջ դերը հաջողությամբ փոխվեց։');
    }
}