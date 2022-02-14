<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    private $request;
    public funciotn __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return view('admin.permissions.table', get_defined_vars());
        }

        return view('admin.permissions.index', get_defined_vars());
    }

    public function addPermission(Request $request)
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

        $alreadyExists = Permission::where('name', $request->name)->first();
        if (empty($alreadyExists)) {
            if ($request->id) {
                $permission = Permission::find($request->id);
                $message = "Permission Data Updated";
            } else {
                $permission = new Permission();
                $message = 'Permission Created Successfully';
            }

            $permission->name = $request->name;
            $permission->guard_name = 'web';
            if ($permission->save()) {
                return sendResponse(200, $message);
            }

            return sendResponse(400, 'Something Went Wrong');
        }

        return sendResponse(201, 'Already Exists');
    }

    public function getPermission(Request $request)
    {
        $permission = Permission::find($request->id);
        if (!empty($permission)) {
            return sendResponse(200, 'Data Fetched', $permission);
        }
        return sendResponse(201, 'Data Not Found');
    }

    public function deletePermission(Request $request)
    {
        $permission = Permission::find($request->id);
        if (!empty($permission)) {
            $permission->delete();
            return sendResponse(200, 'Permission Data Deleted Successfully', $permission);
        }
        return sendResponse(201, 'Data Not Found');
    }
}
