<?php 

namespace App\Repository;

use App\Models\Package;
use App\Models\Team;
use App\Repository\Interfaces\InterfacePackageRepository;
// use App\Helper\PaypalHelpers;

class PackageRepository implements InterfacePackageRepository{

	protected $package = null;

	public function getAllPackages(){
    
		return Package::all();
	}
	public function getPackageById($id){
		return Package::find($id);
	}
	public function createOrUpdate($id = null, $collection = []){
        
        
		if(is_null($id)){
			$package = new Package();
		}else{
            $package = Package::find($id);

        }
        
            $collection['image'] = '';

            if(!empty($collection['icon']) && file_exists($collection['icon'])){
            	$file = $collection['icon']; 
            	$upload_path = '/app/public/packages/icon/';
                if(!empty($package)){
                    $result = upload_image($file, $upload_path, $package->icon);
                }else{
                	$result = upload_image($file, $upload_path);
                }
            	$package->icon = 'storage/packages/icon/'.$result;
                
                $collection['image'] = url('/').'/storage/packages/icon/'.$result;
                if(!empty($package->id)){
                    // $package->stripe_plan = update_package($collection, $package->stripe_plan, env('STRIPE_SECRET'));
                }else{
                    // $package->stripe_plan = create_package($collection, env('STRIPE_SECRET'));
                }
            }
            
            $collection['interval_unit'] = 'MONTH';
            $collection['interval_count'] = '1';
            // paypal
            // $plans = new PaypalHelpers();
            
            // $response = $plans->create_subscription($collection);
            // dd($response);
            $request_id = 'create-plan-'.time();
            $data = [];
            if(!empty($package->id)){
                // paypal
                // $plan_id = $package->paypal_plan;
                // $response = $plans->update_plan($collection,$plan_id);
                // stripe
                //$package->stripe_plan = ''; // update_package($collection, $package->stripe_plan, env('STRIPE_SECRET'));
            }else{
                // paypal    
                // $response = $plans->create_plan($collection, $request_id);
                // $package->paypal_plan = $response;
                // stripe
                //$package->stripe_plan = ''; // create_package($collection, env('STRIPE_SECRET'));
            }
            
            $package->title = $collection['title'];
            $package->duration = $collection['duration'];
            $package->price = $collection['price'];
            $package->manager = $collection['manager'];
            $package->users = $collection['users'];
            $package->support_text = $collection['support_text'];
            $package->storage_text = $collection['storage_text'];
            $package->heading = $collection['heading'];
            $package->sub_heading = $collection['sub_heading'];
            $package->package_name = $collection['package_name'];
            $package->currency = $collection['currency'];
            $package->package_type_text = $collection['package_type_text'];
            $package->storage_place_size = $collection['storage_place_size'];
            $package->button_text = $collection['button_text'];
            $package->description = $collection['description'];
        

			$package->created_by = auth()->user()->id;

			return $package->save();
	
	}
	public function deletePackage($id){
		return Package::find($id)->delete();
	}

    public function deleteMultiplePackages($collection = []){

         if (isset($collection['ids']) && !empty($collection['ids'])) {
            foreach ($collection['ids'] as $key => $value) {
                 $id = base64_decode($value);
                 $this->deletePackage($id);
             } 
        }
        return true;
    }

    
}