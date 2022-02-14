<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return view('admin.roles.table', get_defined_vars());
        }

        return view('admin.roles.index', get_defined_vars());
    }

    public function addRole(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ],[
            'name.required' => __('messages.name_required'),
            'name.string' => __('messages.name_string'), 
        ]);

        if ($v->fails()) {
            return sendResponse(201, $v->errors()->first());
        }


        $alreadyExists = Role::where('name', $request->name)->first();
        if (empty($alreadyExists)) {
            if ($request->id) {
                $role = Role::find($request->id);
                $message = "Role Data Updated";
            } else {
                $role = new Role();
                $message = "Role Created Successfully";
            }

            $role->name = $request->name;
            $role->guard_name = 'web';
            if ($role->save()) {
                return sendResponse(200, $message);
            }

            return sendResponse(400, 'Something Went Wrong');
        }
        return sendResponse(201, 'Already Exists');
    }

    public function getRole(Request $request)
    {
        $role = Role::find($request->id);
        if (!empty($role)) {
            return sendResponse(200, 'Data Fetched', $role);
        }

        return sendResponse(400, 'Data Not Found');
    }

    public function deleteRole(Request $request)
    {
        $role = Role::find($request->id);
        if (!empty($role)) {
            $role->delete();
            return sendResponse(200, 'Role Data Deleted Successfully');
        }
        return sendResponse(201, 'Data Not Found');
    }

    public function roleHasPermissions($id)
    {
        $id = base64_decode($id);
        $role = Role::find($id);
        $name = $role->name;
        $rolePermissions = $role->permissions;
        // dd($rolePermissions);
        $permissions = Permission::all();

        return view('admin.roles.rolehaspermissions', get_defined_vars());
    }

    public function assignRolePermissions(Request $request)
    {
        // dd($request->all());
        $role = Role::where('name', $request->name)->first();
        $result = $role->syncPermissions($request->permissions);
        if ($result) {
            return sendResponse(200, 'Updated Role Permissions');
        }
        sendResponse(400, 'Something Went Wrong');
    }
}
