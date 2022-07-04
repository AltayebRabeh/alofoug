<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreUserRequest;
use Spatie\Activitylog\Models\Activity;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->with(['permissions', 'roles'])->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        $permissions = Permission::get();

        return view('backend.users.create', compact('permissions'));
    }

    public function store(StoreUserRequest $request)
    {
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
         ]);

         if($request->permissions)
            $user->permissions()->sync($request->permissions);

        Alert::success('نجاح','تم إضافة المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function edit(User $user) {

        $user = User::with('permissions')->whereDoesntHave('roles')->findOrFail($user->id);

        $permissions = Permission::get();

        return view('backend.users.edit', compact('user', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
         $user = User::findOrFail($user->id);

         if($request->permissions)
            $user->permissions()->sync($request->permissions);

        Alert::success('نجاح','تم تعديل المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        User::findOrFail($user->id)->delete();

        Alert::success('نجاح','تم إضافة المستخدم بنجاح');
        return redirect()->route('users.index');
    }

}
