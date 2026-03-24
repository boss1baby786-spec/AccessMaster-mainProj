<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
public function __construct()
{
    $this->middleware('permission:permissions.index')->only('index');
    $this->middleware('permission:permissions.create')->only(['create','store']);
    $this->middleware('permission:permissions.delete')->only('destroy');
}


// *****************************************List ALL Roles********************************************
public function index()
{
$permissions=Permission::all();
return view('permissions.index',compact('permissions'));

}

// *****************************************View Create Permission********************************************

public function create()
{

return view('permissions.create');
}

// *****************************************Create New Role********************************************

public function store(Request $request)
{

    $validatedata=$request->validate([
        'name'=>'required|string|unique:permissions,name',
        
    ]);
    Permission::create([
        'name'=>$validatedata['name'],
    ]);
    
    return redirect()->route('permissions.index')->with('success',"Permission Created Successfully");
}



// *****************************************Delete the Permission********************************************
public function destroy(Permission $permission)

{
$permission->delete();
 return redirect()->route('permissions.index')->with('success','Permission deleted successfully');
}


}
