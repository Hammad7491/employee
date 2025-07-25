<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    // Show create user form
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', [
            'roles'     => $roles,
            'userRoles' => [],
        ]);
    }

    // Store new user
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'roles'    => 'required|array',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->syncRoles($data['roles']);

        return redirect()
               ->route('admin.users.index')
               ->with('success', 'User created.');
    }

    // Show edit form
    public function edit(User $user)
    {
        $roles     = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('admin.users.create', compact('user', 'roles', 'userRoles'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required','email','max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|confirmed|min:6',
            'roles'    => 'required|array',
        ]);

        $user->name  = $data['name'];
        $user->email = $data['email'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();
        $user->syncRoles($data['roles']);

        return redirect()
               ->route('admin.users.index')
               ->with('success', 'User updated.');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
               ->route('admin.users.index')
               ->with('success', 'User deleted.');
    }

    // Show change password form (existing)
    public function showChangePasswordForm()
    {
        return view('auth.change-pswd');
    }

    // Handle password change (existing)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        if (! Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        Auth::user()->update([
            'password' => bcrypt($request->new_password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }

    // Show “My Profile” form
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile.create', compact('user'));
    }

    // Update “My Profile”
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => [
                'required','email','max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable','string','min:6','confirmed'],
        ]);

        $user->name  = $data['name'];
        $user->email = $data['email'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return back()->with('success', 'Your profile has been updated.');
    }
}
