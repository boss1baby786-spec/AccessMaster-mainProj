<?php

namespace App\Http\Controllers;

use App\Events\RolePermissionUpdated;
use App\Events\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{




    public function __construct()
    {
        $this->middleware('permission:roles.index')->only('index');
        $this->middleware('permission:roles.create')->only(['create', 'store']);
        $this->middleware('permission:roles.edit')->only(['edit', 'update']);
        $this->middleware('permission:roles.delete')->only('destroy');
    }


    // *****************************************List ALL Roles********************************************
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    // *****************************************Create Roles Permission********************************************

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    // *****************************************Create New Role********************************************

    public function store(Request $request)
    {

        $validatedata = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array'
        ]);
        $role = Role::create([
            'name' => $validatedata['name'],
        ]);
        if (!empty($validatedata['permissions'])) {
            $role->syncPermissions($validatedata['permissions']);
        }
        return redirect()->route('roles.index')->with('success', "Role Created Successfully");
    }

    // *****************************************Show Edit Form********************************************

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    // *****************************************Update Role Permisssion********************************************
    public function update(Request $request, Role $role)
    {
        $datavalidate = $request->validate([
            'permissions' => 'nullable|array'
        ]);
        $role->syncPermissions($datavalidate['permissions'] ?? []);


        // **************************************EVENT FOR ROLE UPDATE**************************************************
       
      $message = "Admin " . Auth::user()->name . " updated permissions for role " . $role->name;

        event(new RolePermissionUpdated(
           $message,
            $role->name,
            Auth::id()

        ));
        Log::info("Role update event fired", [
    'role' => $role->name,
    'updated_by' => Auth::id()
]);

        return redirect()->route('roles.index')->with('success', 'Permissions Updated successfully');
        
    }
    // *****************************************Delete the Role********************************************
    public function destroy(Role $role)

    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
