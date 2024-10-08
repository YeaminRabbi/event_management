<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'role_or_permission:role-permission-module',
        ];
    }

    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('adminpanel.role.index', compact('roles','permissions'));
    }

    public function role_add(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Role::create(['name' =>  strtolower($request->name)]);
        return back()->with('success', 'Successfully Role has been created!');
    }

    public function role_delete($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return back()->with('success', 'Successfully Role has been deleted!');

    }

    public function get_role($id)
    {
        $role = Role::findById($id);

        return response()->json([
            'data' => $role
        ]);

    }

    public function role_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role_id' => 'required'
        ]);
        $role = Role::findById($request->role_id);
        $role->name = strtolower($request->name);
        $role->save();

        return back()->with('success', 'Successfully Role has been updated!');
    }


    public function permission_add(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Permission::create(['name' =>  str_replace(' ', '-', strtolower(trim($request->name)))]);
        return back()->with('success', 'Successfully Permission has been created!');
    }

    public function permission_delete($id)
    {
        // return
        $permission = Permission::findById($id);
        $permission->delete();
        return back()->with('success', 'Successfully Permission has been deleted!');

    }

    public function get_permission($id)
    {
        $permission = Permission::findById($id);

        return response()->json([
            'data' => $permission
        
        ]);

    }

    public function permission_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission_id' => 'required'
        ]);
        $permission = Permission::findById($request->permission_id);
        $permission->name =  str_replace(' ', '-', strtolower(trim($request->name)));
        $permission->save();

        return back()->with('success', 'Successfully Role has been updated!');
    }


    public function role_permission_assign(Request $req)
    {
        $req->validate([
            'role_id' => 'required',
            'selected_permission' => 'required'
        ]);

        $role = Role::findById($req->role_id);
        $role->syncPermissions([]);
        $role->givePermissionTo($req->selected_permission);
        return back()->with('success', 'Successfully Permission Assigned!');
    }

    public function role_permission_revoke($id)
    {
        $role = Role::findById($id);
        $role->syncPermissions([]);

        return back()->with('success', 'Permission Revoked from the role!');

    }


    public function fetch_permissions($id)
    {
        $role = Role::findById($id);
        $permissions = $role->permissions;

        $permission_list = Permission::get();

        $permission_list = $permission_list->map(function ($permission) {
            return [
              'id' => $permission->id,
              'name' => $permission->name,
            ];
        });

        $permissions = $permissions->map(function ($permission) {
            return [
              'id' => $permission->id,
              'name' => $permission->name,
            ];
        });

        return response()->json([
            'role_has_permission' => $permissions,
            'permission_list'=> $permission_list
        ]);

    }

}
