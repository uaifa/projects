<?php 

namespace App\Repository;

use App\Models\Client;
use App\Repository\Interfaces\InterfaceClientRepository;
use App\Models\ContactPerson;

class ClientRepository implements InterfaceClientRepository{

	protected $clients = null;

	public function getAllClients(){
		return Client::all();
	}
	public function getClientById($id){
		return Client::find($id);
	}
	public function createOrUpdate($id = null, $collection = []){

		// dd($collection);
		if(is_null($id)){
			$client = new Client();
		}else{
			$client = Client::find($id);
		}

		$client->company = $collection['company'];
		$client->first_name = isset($collection['first_name']) ? $collection['first_name'] : '';
		$client->last_name = isset($collection['last_name']) ? $collection['last_name'] : '';
		$client->email = isset($collection['email']) ? $collection['email'] : '';
		$client->street = isset($collection['street']) ? $collection['street'] : '';
		$client->house_no = isset($collection['house_no']) ? $collection['house_no'] : '';
		$client->zip_code = isset($collection['zip_code']) ? $collection['zip_code'] : '';
		$client->town = isset($collection['town']) ? $collection['town'] : '';
		$client->telephone = isset($collection['telephone']) ? $collection['telephone'] : '';
		$client->branch = isset($collection['branch']) ? $collection['branch'] : '';
		// $client->status = $collection['status'];
		$client->additional_address = isset($collection['additional_address']) ? $collection['additional_address'] : '';
		$client->corporate_client = $collection['corporate_client'];
		$client->address = isset($collection['address']) ? $collection['address'] : '';
		$client->place = isset($collection['place']) ? $collection['place'] : '';

		$client->customer_name = isset($collection['customer_name']) ? $collection['customer_name'] : '';
		$client->longitude = isset($collection['longitude']) ? $collection['longitude'] : null;
        $client->latitude = isset($collection['latitude']) ? $collection['latitude'] : null;

		$client->created_by = auth()->user()->id;
		$client->save();
		$client_id = $client->id;
		if(isset($collection['contact_persons']) && !empty($collection['contact_persons'])){
			
			$contact_persons = json_decode($collection['contact_persons'], JSON_FORCE_OBJECT);
			
			$data = [];
			foreach ($contact_persons as $key => $value) {

				array_push($data, ['name' => $value['name'], 'email' => $value['email'], 'phone_number' => $value['phone_number'], 'functions' => $value['functions'], 'client_id' => $client_id, 'created_by' => auth()->user()->id ]);

				// $data['name'] = $value['name'];
				// $data['email'] = $value['email'];
				// $data['phone_number'] = $value['phone_number'];
				// $data['functions'] = $value['functions'];
				// $data['client_id'] = $client_id;
				// $data['created_by'] = auth()->user()->id;
			}

			if(!empty($data)){
				ContactPerson::where('client_id',$client_id)->delete();
				$contact_person = ContactPerson::insert($data);
			}
		}

		if(isset($collection['contact_person']) && !empty($collection['contact_person'])){
			$data = [];
			for ($i=0; $i < count($collection['contact_person']); $i++) {

				array_push($data, ['name' => $collection['contact_person'][$i], 'email' => $collection['contact_person_email'][$i], 'phone_number' => $collection['contact_person_phone_number'][$i], 'functions' => $collection['contact_person_function'][$i], 'client_id' => $client_id, 'created_by' => auth()->user()->id ]);
			}

			ContactPerson::where('client_id',$client_id)->delete();
			ContactPerson::insert($data);
		}
		return $client;
	}
	public function deleteClient($id){
		return Client::find($id)->delete();
	}

	public function deleteMultipleClients($collection = []){

		 if (isset($collection['ids']) && !empty($collection['ids'])) {
            foreach ($collection['ids'] as $key => $value) {
                 $id = base64_decode($value);
                 $this->deleteClient($id);
             } 
        }
        return true;
	}

	
}