<?php 

namespace App\Repository;

// use App\Models\StaffMember;
use App\Models\User;
use App\Repository\Interfaces\InterfaceStaffMemberRepository;
use Illuminate\Support\Facades\Hash;

class StaffMemberRepository implements InterfaceStaffMemberRepository{

	protected $staff_members = null;

	public function getAllStaffMembers(){
		return User::with('teams')->where('user_type', 'staffmember')->get();
	}
	public function getStaffMemberById($id){
		return User::where('user_type', 'staffmember')->where('id',$id)->first();
	}
	public function createOrUpdate($id = null, $collection = []){

		if(is_null($id)){
			$staff_member = new User();
            $staff_member->email = $collection['email'];
            $staff_member->password = isset($collection['password']) ? Hash::make($collection['password']) : null;
		}else{
            $staff_member = User::with('teams')->where('user_type', 'staffmember')->where('id',$id)->first();
            if(!$collection['email'] == $staff_member->email){
                $staff_member->email = $collection['email'];
            }
            if(isset($collection['password']) && !empty($collection['password'])){
                $staff_member->password = Hash::make($collection['password']);
            }
        }

        if(!empty($collection['profile_image']) && file_exists($collection['profile_image'])){
        	$file = $collection['profile_image']; 
        	$upload_path = '/app/public/staff_members/profile_image/';
            if(!empty($package)){
                $result = upload_image($file, $upload_path, $package->profile_image);
            }else{
            	$result = upload_image($file, $upload_path);
            }
            $collection['profile_image'] = 'storage/staff_members/profile_image/'.$result;
            $staff_member->profile_image = $collection['profile_image'];
        }else{
            if(isset($collection['profile_image']) && $base64_file = base64_image_content($collection['profile_image'])){
                $profile_name = create_image_from_base_64($collection['profile_image']);
                $staff_member->profile_image = !empty($profile_name) ? $profile_name : '';
            }else{
                if(isset($collection['profile_image_url']) && !empty($collection['profile_image_url'])){
                    $staff_member->profile_image = $collection['profile_image_url'];
                }
            }
        }

        $staff_member->user_type = 'staffmember';
        $staff_member->private_address = isset($collection['private_address']) ? $collection['private_address'] : null;
        $staff_member->first_name = $collection['first_name'];
        $staff_member->last_name = $collection['last_name'];
        $staff_member->phone_number = isset($collection['phone_number']) ? $collection['phone_number'] : null;
        $staff_member->mobile_number = isset($collection['mobile_number']) ? $collection['mobile_number'] : null;
        $staff_member->house_number = isset($collection['house_number']) ? $collection['house_number'] : null;
        $staff_member->zip_code = isset($collection['zip_code']) ? $collection['zip_code'] : null;
        $staff_member->city = isset($collection['city']) ? $collection['city'] : null;
        $staff_member->country = isset($collection['country']) ? $collection['country'] : null;
		$staff_member->created_by = auth()->user()->id;
		$staff_member->save();

        if(isset($collection['roles'])){
            $staff_member->syncRoles($collection['roles']);
        }

        if(isset($collection['teams']) && !empty($collection['teams'])){
            $teams = is_json($collection['teams']);
            $staff_member->teams()->sync($teams);
        }
        return $staff_member;
	}
	public function deleteStaffMember($id){
		return User::with('teams')->where('user_type', 'staffmember')->where('id',$id)->delete();
	}

    public function uploadProfileImage($id, $collection = []){

        $staff_member = User::with('teams')->where('user_type', 'staffmember')->where('id',$id)->first();
        
        if(!empty($collection['profile_image']) && file_exists($collection['profile_image'])){
            $file = $collection['profile_image']; 
            $upload_path = '/app/public/staff_members/profile_image/';
            if(!empty($package)){
                $result = upload_image($file, $upload_path, $package->profile_image);
            }else{
                $result = upload_image($file, $upload_path);
            }
            $collection['profile_image'] = 'storage/staff_members/profile_image/'.$result;
            $staff_member->profile_image = $collection['profile_image'];
        }
        
        $staff_member->save();

        return $staff_member;

    }
    public function deleteMultipleStffMembers($collection = []){

        if (isset($collection['ids']) && !empty($collection['ids'])) {
            foreach ($collection['ids'] as $key => $value) {
                 $id = base64_decode($value);
                 $this->deleteStaffMember($id);
             } 
        }
        return true;
    }
}