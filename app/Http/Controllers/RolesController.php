<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{

    public function show()
    {
        return view('content.pages.settings.add-role');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'role_name' => 'required|string',
      ]);
      // \Log::info($request->all());
      $roles = new Roles();
      $roles->role_name = $request->role_name;
      $roles->comments = $request->comments;
    //   $ecf->prepared_by = auth()->id();

      $roles->save();
      return response()->json([
        'status' => 'success',
        'message' => 'Role created successfully',
        'role' => $roles,

    ]);
    }


    public function AllRoles( Request $request )
    {
        $roles = DB::table('role')->get();
        return view('content.pages.settings.roles', compact('roles') );
    }

    public function AllRoles2( Request $request )
    {
        // $items = Role::get();
        $roles =  Role::select('role_name', 'id')->get();
        return view('content.pages.users.users', compact('roles') );
    }

    // public function id()
    // {
    //     return $this->belongsTo(Role::class);
    // }
}
