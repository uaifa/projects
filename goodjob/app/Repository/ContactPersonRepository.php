<?php 

namespace App\Repository;

use App\Models\ContactPerson;
use App\Repository\Interfaces\InterfaceContactPersonRepository;

class ContactPersonRepository implements InterfaceContactPersonRepository{

	protected $customers = null;

	public function getAllContactPerson(){
		return ContactPerson::all();
	}
	public function getContactPersonById($id){
		return ContactPerson::find($id);
	}
	public function createOrUpdate($id = null, $collection = []){


		if(is_null($id)){
			$employee = new ContactPerson();
		}else{
            $employee = ContactPerson::find($id);
        }
        $employee->name = $collection['contact_person_name'];
        $employee->email = $collection['contact_person_email'];
        $employee->functions = $collection['contact_person_functions'];
        $employee->customer_id = $collection['customer_id'];
        $employee->phone_number = $collection['contact_person_phone_number'];
        $employee->status = $collection['contact_person_status'];
		$employee->created_by = auth()->user()->id;
		return $employee->save();
	}
	public function deleteContactPerson($id){
		return ContactPerson::find($id)->delete();
	}
}