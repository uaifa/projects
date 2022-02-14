<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\User\WelcomeMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use App\Notifications\User\ForgetPassword;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Services\UploadImage;
use App\Notifications\User\WelcomeNotification;
use App\Http\Controllers\Services\CreateFolders;
use App\Mail\User\ForgotPasswords;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function signup(Request $request)
    {
       
        $headers = apache_request_headers();
        // dd($headers['Os']);
        $msg = check_headers($headers);
        if (!empty($msg)) {
            return sendErrorResponse($msg);
        }
        $v = Validator::make($request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                            'required',
                            'min:8',
                            'max:20',
                            'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,20}$/'
                        ],
        ],[
            'first_name.required' => __('messages.first_name_required'),
            'first_name.string' => __('messages.first_name_string'),
            'last_name.required' => __('messages.last_name_required'),
            'last_name.string' => __('messages.last_name_string'),
            'email.required' => __('messages.email_required'),
            'email.string' => __('messages.email_string'),
            'email.email' => __('messages.email_email'),
            'email.unique' => __('messages.email_unique'),
            'password.required' => __('messages.password_required'),
            'password.regex' => __('messages.password_regex'),
            
        ]);

        if ($v->fails()) {
            return sendErrorResponse($v->errors()->first());
        }

        $slug = Str::slug($request->first_name . ' ' . $request->last_name);

        if (User::where('slug', $slug)->count() > 0) {
            $slug = $slug . '-' . rand(0, 100000);
        }
        // dd('ok');
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->slug = $slug;
        $user->role_id = 2;
        $user->os = $headers['Os'];
        $user->resolution = $headers['Resolution'];
        $user->device_name = $headers['Device-Name'];
        $user->device_token = $headers['Device-Token'];
        $user->is_notification = 1;
        $user->lat = $request->lat ? $request->lat : null;
        $user->long = $request->long ? $request->long : null;
        if ($user->save()) {
            $user->assignRole('User');
            // Mail::to($request->email)->send(new WelcomeMail);
            $admins = User::where('is_admin', 1)->get();
            
            // event(new WelcomeMail($user));

            Notification::send($admins, new WelcomeNotification($user));
            $token = $user->createToken('goodjob')->plainTextToken;
            $user['token'] = $token;
            return sendSuccessResponse('User Created', $user);
        }
        return sendErrorResponse('Something Went Wrong');
    }

    public function signin(Request $request)
    {
        $headers = apache_request_headers();
        $msg = check_headers($headers);
        if (!empty($msg)) {
            return sendErrorResponse($msg);
        }

        $v = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],[
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_email'),
            'password.required' => __('messages.password_required')
        ]);

        if ($v->fails()) {
            return sendErrorResponse($v->errors()->first());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()) {
                $user = User::find(Auth::user()->id);
                $user->os = $headers['Os'];
                $user->resolution = $headers['Resolution'];
                $user->device_name = $headers['Device-Name'];
                $user->device_token = $headers['Device-Token'];
                $user->lat = $request->lat ? $request->lat : null;
                $user->long = $request->long ? $request->long : null;
                $user->save();

                $token = $user->createToken('goodjob')->plainTextToken;
                $user['token'] = $token;
                return sendSuccessResponse('Successfully Login', $user);
            }
        }
        return sendErrorResponse('Invalid Credentials');
    }

    public function logout()
    {
        Auth::logout();
        return sendSuccessResponse('Logout Successfully');
    }

    public function forget_password(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => ['required', 'email']
        ],[
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_email'),
        ]);

        if ($v->fails()) {
            return sendErrorResponse($v->errors()->first());
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // $user->forget_code = forgetCode();
            $user->forget_code = 12345;
            $user->save();
            $admins = User::find(1);
            $admin['email'] = 'good-job@demos-project.biz';
            $admin['forget_code'] = $user->forget_code;
            
            Mail::to($user)->send(new ForgotPasswords($admin));
            
            // Mail::to($admins)->send(new ForgetPassword());
            // Notification::send($admins, new ForgetPassword($user));
            return sendSuccessResponse('Forget Password Email Send At Your Email Address');
        }
        return sendErrorResponse('No Record Found');
    }

    public function reset_forget_password(Request $request)
    {
        
        $v = Validator::make($request->all(), [
            'forget_code' => ['required', 'numeric'],
            'password' => ['required', 'min:8', 'max:20', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,20}$/'],
            'confirm_password' => ['required', 'same:password']
        ],[
            'forget_code.required' => __('messages.forget_code_required'),
            'forget_code.numeric' => __('messages.forget_code_numeric'),
            'password.required' => __('messages.password_required'),
            'confirm_password.confirmed' => __('messages.confirm_password_required'),
        ]);

        if ($v->fails()) {
            return sendErrorResponse($v->errors()->first());
        }

        $user = User::where('forget_code', $request->forget_code)->first();
        if (!empty($user)) {
            $user->password = Hash::make($request->password);
            $user->forget_code = null;
            $user->save();

            return sendSuccessResponse('Reset Password Successfully');
        }

        return sendErrorResponse('Invalid Code');
    }

    public function reset_password(Request $request)
    {
        $v = Validator::make($request->all(), [
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
            'new_password' => ['required', 'min:8',
                            'max:20',
                            'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,20}$/'],
            'confirm_password' => ['required', 'same:new_password'],
        ],[
            'old_password.required' => __('messages.old_password_required'),
            'new_password.required' => __('messages.new_password_required'),
            'confirm_password.required' => __('messages.confirm_password_required'),
             
        ]);

        if ($v->fails()) {
            return sendErrorResponse($v->errors()->first());
        }
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        if ($user->save()) {
            return sendSuccessResponse('Password Reset Successfully');
        }
        return sendErrorResponse('Something Went Wrong');
    }

    public function profile_image(Request $request)
    {
        $v = Validator::make($request->all(), [
            'image' => ['required', 'mimes:jpeg,jpg,png']
        ],[
            'image.required' => __('messages.image_required'),
        ]);

        if ($v->fails()) {
            return sendErrorResponse($v->errors()->first());
        }

        $createFolder = new CreateFolders();
        $path = $createFolder('user');
        $imageObj = new UploadImage();
        $imageName = $imageObj($request, $path);
        $user = User::find(Auth::user()->id);
        $user->avatar = 'storage/' . $path . $imageName;
        if ($user->save()) {
            return sendSuccessResponse('Image Uploaded Successfully');
        }
        return sendErrorResponse('Something Went Wrong');

        // dd($path);
        // $imaheName = imageUpload($request);
        // if ($status == true) {
        //     return sendResponse('success', 'Image Uploaded Successfully');
        // }

        // dd($request->all());
    }

    public function socialLogin(Request $request)
    {
        $headers = apache_request_headers();
        $msg = check_headers($headers);
        if (!empty($msg)) {
            return sendErrorResponse($msg);
        }
        $v = Validator::make($request->all(), [
            'provider' => ['required', 'string'],
            'token' => ['required']
        ],[
            'provider.required' => __('messages.provider_required'),
            'provider.string' => __('messages.provider_string'),
            'token.required' => __('messages.token_required'),
        ]);

        if ($v->fails()) {
            return sendErrorResponse($v->errors()->first());
        }
        try {
            $providerUser = Socialite::driver($request->provider)->userFromToken($request->token);
            if (empty($providerUser->email)) {
                return sendErrorResponse('First Add Email On ' . $request->provider == "Facebook" ? 'Facebook' : 'Google');
            }
        } catch (\Throwable $th) {
            return sendErrorResponse('Invalid token '.$th->getMessage());
        }
        $user = User::whereProviderAndProviderId($request->provider, $providerUser->id)->first();
        $msg = !empty($user) ? 'Login Successfully' : 'User Created Successfully';
        if (empty($user)) {
            $user = new User();
            $user->provider = $request->provider;
            $user->provider_id = $providerUser->id;
            $user->email = $providerUser->email;
            $name = explode(' ', $providerUser->name);
            $user->first_name = $name[0];
            $user->last_name = $name[1];
            $slug = Str::slug($name[0] . ' ' . $name[1]);
            if (User::where('slug', $slug)->count() > 0) {
                $slug = $slug . '-' . rand(0, 100000);
            }
            $user->email = $providerUser->email ? $providerUser->email : null;
            // $user->phone = $providerUser->phone ? $providerUser->phone : null;
            $user->slug = $slug;
            $user->email_verified_at = now();
            $user->avatar = $providerUser->avatar ? $providerUser->avatar : null;
        }
        $user->os = $headers['Os'];
        $user->resolution = $headers['Resolution'];
        $user->device_name = $headers['Device-Name'];
        $user->device_token = $headers['Device-Token'];
        $user->lat = $request->lat ? $request->lat : null;
        $user->long = $request->long ? $request->long : null;
        if ($user->save()) {
            $token = $user->createToken('goodjob')->plainTextToken;
            $user['token'] = $token;
            return sendSuccessResponse($msg, $user);
        }
        return sendErrorResponse('Something Went Wrong');
    }
}
