<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\User;


class PaymentsController extends Controller
{
    
    public function index($package_id = ''){
        $result_s = decryptstring($package_id);
        if(isset($result_s['status'])){
            smilify('error', __('messages.something_went_wrong'));
            return back();
        }else{
            $package_detail = Package::find(decryptstring($package_id));
            if($package_detail->price == 0){
                $users = User::find(auth()->user()->id);
                $users->package_type = request()->package_type;
                $users->payment_status = 1;
                $users->payment_type = 'free';
                $users->stripe_start_date = now();
                $users->package_start_date_time = now();
                $users->save();

                smilify('success', 'Your plan subscribed successfully!');
                return redirect()->to('admin/dashboard');
                dd("oka");
            }

        }
        return view('website.pages.payments.index', compact('package_id'));
    
    }
}
