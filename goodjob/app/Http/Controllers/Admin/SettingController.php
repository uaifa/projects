<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function profileSetting(Request $request)
    {
        $v = Validator::make($request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string']
        ],[
            'first_name.required' => __('messages.first_name_required'),
            'first_name.string' => __('messages.first_name_string'), 
            'last_name.required' => __('messages.last_name_required'),
            'last_name.string' => __('messages.last_name_string'), 
        ]);
        if ($v->fails()) {
            return sendResponse(201, $v->errors()->first());
        }

        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone ? $request->phone : null;
        $user->dob = $request->dob  ? date("Y-m-d H:i:s", strtotime($request->dob))  : ($user->dob ? $user->dob : null);
        if ($user->save()) {
            return sendResponse(200, 'Profile Updated Successfully');
        }

        return sendResponse(400, 'Something Went  Wrong');
    }

    public function UploadImage(Request $request)
    {
        // dd($request->all());
        $v = Validator::make($request->all(), [
            'image' => ['required', 'mimes:png,jpg']
        ],[
            'image.required' => __('messages.image_required')
        ]);

        if ($v->fails()) {
            return sendResponse(201, $v->errors()->first());
        }

        $path = 'admin/images/';
        $img = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/' . $path, $img);
        $user = User::find(Auth::user()->id);
        $user->avatar = 'storage/' . $path . $img;
        if ($user->save()) {
            return sendResponse(200, 'Image Change Successfully');
        }

        return sendResponse(400, 'Something Went Wrong');
    }

    public function securitySetting()
    {
        return view('admin.securitysettings');
    }

    public function resetPassword(Request $request)
    {
        $v = Validator::make($request->all(), [
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
            'new_password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->symbols()
                    ->numbers()
                    ->mixedCase()
            ],
            'confirm_password' => ['required', 'same:new_password'],
        ],[
            'old_password.required' => __('messages.old_password_required'),
            'new_password.required' => __('messages.new_password_required'), 
        ]);

        if ($v->fails()) {
            return sendResponse(201, $v->errors()->first());
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        if ($user->save()) {
            return sendResponse(200, 'Password Updated Successfully');
        }
        return sendResponse(400, 'Something Went Wrong');
    }
}
