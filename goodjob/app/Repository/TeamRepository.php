<?php 

namespace App\Repository;

use App\Models\Team;
use App\Repository\Interfaces\InterfaceTeamRepository;

class TeamRepository implements InterfaceTeamRepository{

	protected $teams = null;

	public function getAllTeams(){
		return Team::all();
	}
	public function getTeamById($id){
		return Team::find($id);
	}
	public function createOrUpdate($id = null, $collection = []){


		if(is_null($id)){
			$team = new Team();
		}else{
			$team = Team::find($id);
		}
		$team->name = $collection['name'];
		$team->description = $collection['description'];
		$team->address = $collection['address'];
		$team->city = $collection['city'];
		$team->country = $collection['country'];
		$team->zip_code = $collection['zip_code'];
		$team->status = isset($collection['status']) ? $collection['status'] : 1;
		$team->created_by = auth()->user()->id;
		$team->save();

		if(isset($collection['skills']) && !empty($collection['skills'])){
            $skills = is_json($collection['skills']);
            $team->skills()->sync($skills);
        	}

        return $team;

	}
	public function deleteTeam($id){
		return Team::find($id)->delete();
	}

	public function deleteMultipleTeams($collection = []){

		 if (isset($collection['ids']) && !empty($collection['ids'])) {
            foreach ($collection['ids'] as $key => $value) {
                 $id = base64_decode($value);
                 $this->deleteTeam($id);
             } 
        }
        return true;
	}

}