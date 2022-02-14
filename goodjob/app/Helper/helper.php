<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;


if (!function_exists('sendSuccessResponse')) {
    function sendSuccessResponse($msg, $data = [])
    {
        return ['status' => true, 'message' => $msg, 'data' => (object)$data];
    }
}

if (!function_exists('sendErrorResponse')) {
    function sendErrorResponse($msg, $data = [])
    {
        return ['status' => false, 'message' => $msg, 'data' => json_encode((object)$data)];
    }
}

if (!function_exists('check_headers')) {
    
    function check_headers($headers)
    {
        if (!isset($headers['Os']) or empty($headers['Os'])) {
            return 'OS is required in header.';
        }
        if (!isset($headers['Resolution']) or empty($headers['Resolution'])) {
            return 'Resolution is required in header.';
        }
        if (!isset($headers['Device-Name']) or empty($headers['Device-Name'])) {
            return 'Device Name is required in header.';
        }
        if (!isset($headers['Device-Token']) or empty($headers['Device-Token'])) {
            return 'Device Token is required in header.';
        }
    }
}

if (!function_exists('forgetCode')) {
    function forgetCode()
    {
        $code = random_int(10000, 99999);
        $alreadyCode = User::where('forget_code', $code)->first();
        if (!empty($alreadyCode)) {
            forgetCode();
        }

        return $code;
    }
}

if (!function_exists('imageUpload')) {
    function imageUpload($request)
    {
        $date = date('Y/m/d', strtotime(now()));
        $path = 'users/'  . $date . '/' . 'images/';
        $file = time() . '.' . $request->image->extension();
        $request->image->storeAs($path, $file);
        $user = User::find(Auth::user()->id);
        $user->avatar = 'storage/' . $path . $file;
        if ($user->save()) {
            return true;
        }
        return false;
    }
}


if (!function_exists('create_image_from_base_64')) {
    //Function to save a base64 image
    function create_image_from_base_64($file = ''){

            $date = date('Y/m/d', strtotime(now()));
            $path_img = storage_path('app/public/staff_members/'  . $date . '/' . 'profile_image/');
            if(!File::isDirectory($path_img)){
                File::makeDirectory($path_img, 0777, true, true); 
            }
            if($file){
                $file_data = $file;
            }else{
                $file_data = request()->profile_image;
            }
            $png_url = "images_".time().".png";
            $path = storage_path('app/public/staff_members/'  . $date . '/' . 'profile_image/') . $png_url;
            // dd($file_data);
            // File::put($path_img. '/' . $png_url, base64_decode($file_data));
            Image::make(file_get_contents($file_data))->save($path);     
            // $data = Image::make($path)->encode($file_data);

            // Image::make(file_get_contents($file_data))->save($path_img);  
        return 'storage/staff_members/'  . $date . '/' . 'profile_image/'.$png_url;
    }
}

if(!function_exists('upload_image')){
    function upload_image($file, $upload_path, $old_file = ''){

        if($file->getClientOriginalExtension() === 'svg' || $file->getClientOriginalExtension() === 'SVG'){
            $result = svg_to_base_64($file);
            return $result;
        }

        $storage_path = storage_path($upload_path);
        if(!File::isDirectory($storage_path)){
            File::makeDirectory($storage_path, 0777, true, true); 
        }

            $old_file = $upload_path . '/' . $old_file;
            if (Storage::exists($old_file)) {
                //delete previous file
                unlink($old_file);
            }

            $file_name = $file->getClientOriginalName();
            $type = $file->getClientOriginalExtension();
            $real_path = $file->getRealPath();
            $size = $file->getSize();
            $size_mbs = ($size / 1024) / 1024;
            $mime_type = $file->getMimeType();

            $file_temp_name = '/packages_' . time() . '.' . $type;
            $old_file = $upload_path . '/' . $file_temp_name;

            $path =  storage_path() .$upload_path. $file_temp_name;
            $img = Image::make($file)->resize(300, 300);
            $img->save($path);

            return $file_temp_name;
            
    }
}



function svg_to_base_64 ($file){  
    $uid = 'packages_' . time();
    $targetdir =  storage_path() .'/app/public/packages/icon/';

    $svg = file_get_contents($file);            
    $image = new \Imagick();
    $image->readImageBlob($svg);
    $image->setBackgroundColor(new \ImagickPixel('transparent'));
    $image->setImageFormat("jpg");
    $image->scaleImage(80,80);
    $image->setFilename($uid);
    $result = $image->writeImage($targetdir.$uid.".jpg"); 
    $file_name = $image->getFilename();
    
    return $result ? $file_name.'.jpg' : false;

}


if(!function_exists('decryptstring')){
    function decryptstring($value){
        try{
            return Crypt::decryptString($value);
        }catch(Exception $e){
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $data;
        }
    }
}

if(!function_exists('encryptstring')){
    function encryptstring($value){
        return Crypt::encryptString($value);
    }
}

if(!function_exists('is_json')){
    function is_json($string) {
        return is_array($string) ? $string : json_decode($string, true);
    }
}

if(!function_exists('base64_image_content')){

    function base64_image_content($base64_image_content){
      if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content)){
        return true;
      }else{
         return false;
     }
    }

}