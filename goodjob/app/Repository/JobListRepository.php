<?php 

namespace App\Repository;

use App\Models\JobsList;
use App\Repository\Interfaces\InterfaceJobListRepository;

class JobListRepository implements InterfaceJobListRepository{

	protected $lob_lists = null;

	public function getAllJobLists(){
		return JobsList::all();
	}
	public function getJobListById($id){
		return JobsList::find($id);
	}
	public function createOrUpdate($id = null, $collection = []){

		if(is_null($id)){
			$job_list = new JobsList();
		}else{
			$job_list = JobsList::find($id);
		}
		// dd($job_list, $collection);
		$job_list->name = $collection['name'];

		if(isset($collection['status']))
			$job_list->status = $collection['status'];
			
		$job_list->description = $collection['description'];
		$job_list->date = date('Y-m-d', strtotime($collection['date']));
		$job_list->from_time_hours = $collection['from_time_hours'];
		$job_list->to_time_minutes = $collection['to_time_minutes'];
		$job_list->client_id = $collection['client_id'];
		$job_list->place_of_work = $collection['place_of_work'];
		$job_list->contact_person = $collection['contact_person'];
		$job_list->phone = $collection['phone'];
		$job_list->email = $collection['email'];
		$job_list->signature = $collection['signature'];
		
		if(isset($collection['role_id']) && !empty($collection['role_id']))
			$job_list->role_id = $collection['role_id'];
		
		$job_list->created_by = auth()->user()->id;
		return $job_list->save();
	}
	public function deleteJobList($id){
		return JobsList::find($id)->delete();
	}

	public function deleteMultipleJobLists($collection = []){

		 if (isset($collection['ids']) && !empty($collection['ids'])) {
            foreach ($collection['ids'] as $key => $value) {
                 $id = base64_decode($value);
                 $this->deleteJobList($id);
             } 
        }
        return true;
	}
}