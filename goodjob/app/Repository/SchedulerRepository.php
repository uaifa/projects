<?php 

namespace App\Repository;

use App\Models\Scheduler;
use App\Models\ContactPerson;
use App\Repository\Interfaces\InterfaceSchedulerRepository;

class SchedulerRepository implements InterfaceSchedulerRepository{

	protected $schedulers = null;

	public function getAllSchedulers(){
		return Scheduler::all();
	}
	public function getSchedulerById($id){
		return Scheduler::find($id);
	}
	public function createOrUpdate($id = null, $collection = []){

		// dd($collection);
		if(is_null($id)){
			$schedulers = new Scheduler();
		}else{
			$schedulers = Scheduler::find($id);
		}

		$schedulers->company = $collection['company'];
		$schedulers->first_name = isset($collection['first_name']) ? $collection['first_name'] : '';
		$schedulers->last_name = isset($collection['last_name']) ? $collection['last_name'] : '';
		$schedulers->email = isset($collection['email']) ? $collection['email'] : '';
		$schedulers->street = isset($collection['street']) ? $collection['street'] : '';
		$schedulers->house_no = isset($collection['house_no']) ? $collection['house_no'] : '';
		$schedulers->zip_code = isset($collection['zip_code']) ? $collection['zip_code'] : '';
		$schedulers->town = isset($collection['town']) ? $collection['town'] : '';
		$schedulers->telephone = isset($collection['telephone']) ? $collection['telephone'] : '';
		$schedulers->branch = isset($collection['branch']) ? $collection['branch'] : '';
		// $schedulers->status = $collection['status'];
		$schedulers->additional_address = isset($collection['additional_address']) ? $collection['additional_address'] : '';
		$schedulers->corporate_client = $collection['corporate_client'];
		$schedulers->address = isset($collection['address']) ? $collection['address'] : '';
		$schedulers->place = isset($collection['place']) ? $collection['place'] : '';

		$schedulers->customer_name = isset($collection['customer_name']) ? $collection['customer_name'] : '';
		$schedulers->longitude = isset($collection['longitude']) ? $collection['longitude'] : null;
        $schedulers->latitude = isset($collection['latitude']) ? $collection['latitude'] : null;

		$schedulers->created_by = auth()->user()->id;
		$schedulers->save();
		$schedulers_id = $schedulers->id;
		if(isset($collection['contact_persons']) && !empty($collection['contact_persons'])){
			
			$contact_persons = json_decode($collection['contact_persons'], JSON_FORCE_OBJECT);
			
			$data = [];
			foreach ($contact_persons as $key => $value) {

				array_push($data, ['name' => $value['name'], 'email' => $value['email'], 'phone_number' => $value['phone_number'], 'functions' => $value['functions'], 'client_id' => $schedulers_id, 'created_by' => auth()->user()->id ]);

				// $data['name'] = $value['name'];
				// $data['email'] = $value['email'];
				// $data['phone_number'] = $value['phone_number'];
				// $data['functions'] = $value['functions'];
				// $data['client_id'] = $schedulers_id;
				// $data['created_by'] = auth()->user()->id;
			}

			if(!empty($data)){
				ContactPerson::where('client_id',$schedulers_id)->delete();
				$contact_person = ContactPerson::insert($data);
			}
		}

		if(isset($collection['contact_person']) && !empty($collection['contact_person'])){
			$data = [];
			for ($i=0; $i < count($collection['contact_person']); $i++) {

				array_push($data, ['name' => $collection['contact_person'][$i], 'email' => $collection['contact_person_email'][$i], 'phone_number' => $collection['contact_person_phone_number'][$i], 'functions' => $collection['contact_person_function'][$i], 'client_id' => $schedulers_id, 'created_by' => auth()->user()->id ]);
			}

			ContactPerson::where('client_id',$schedulers_id)->delete();
			ContactPerson::insert($data);
		}
		return $schedulers;
	}
	public function deleteScheduler($id){
		return Scheduler::find($id)->delete();
	}

	public function deleteMultiplechedulers($collection = []){

		 if (isset($collection['ids']) && !empty($collection['ids'])) {
            foreach ($collection['ids'] as $key => $value) {
                 $id = base64_decode($value);
                 $this->deleteScheduler($id);
             } 
        }
        return true;
	}

	
}