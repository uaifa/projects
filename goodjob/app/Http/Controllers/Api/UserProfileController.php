<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    

    public function update_user_profile(UpdateProfileRequest $request){

        $user = User::find(auth()->user()->id);
        $user->name = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();
        
        $user_profile = UserInfo::updateOrCreate([
                'user_id' => auth()->user()->id  
            ],[
                'private_address' => $request->private_address,
                'house_no' => $request->house_no,
                'zip_code' => $request->zip_code,
                'city' => $request->city,
                'country' => $request->country,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
        ]);

        return sendSuccessResponse(__('messages.user_profile_update_successfully'), $user);
    }
}
