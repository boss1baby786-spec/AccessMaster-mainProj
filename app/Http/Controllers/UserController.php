<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;



class UserController extends Controller
{
    

public function __construct()
{
    $this->middleware('permission:users.index')->only('index');
    $this->middleware('permission:users.create')->only(['create','store']);
    $this->middleware('permission:users.edit')->only(['edit','update']);
    $this->middleware('permission:users.delete')->only('destroy');
    $this->middleware('permission:users.reports')->only('reports');
}






    // **************************LIST ALL USERS****************************************
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // **************************CREATE USER ROLES****************************************
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // **************************CREATE NEW USERS****************************************
    public function store(Request $request)
    {

        $validateData = $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'nullable|array'

        ]);

        $user = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
        ]);
        if (!empty($validateData['roles'])) {
            $user->syncRoles($validateData['roles']);
        }

        return redirect()->route('users.index')->with('success', 'User Created Successfully');
    }

    // **************************show edit form****************************************
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }
    // **************************for Permission testing****************************************
     public function reports()
    {
      
        return view('users.reports');
    }


    // **************************Update the user role****************************************

    public function update(Request $request, User $user)
    {
        $datavalidate = $request->validate([
            'roles' => 'nullable|array'
        ]);
        $user->syncRoles($datavalidate['roles'] ?? []);
        return redirect()->route('users.index')->with('success', 'Roles updated Successfully');
    }
    // **************************Delete the user****************************************
    public function destroy(User $user)
    {

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted Successfully');
    }
}
