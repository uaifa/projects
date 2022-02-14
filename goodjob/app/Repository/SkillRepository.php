<?php 

namespace App\Repository;

use App\Models\Skill;
use App\Repository\Interfaces\InterfaceSkillRepository;

class SkillRepository implements InterfaceSkillRepository{

	protected $skills = null;

	public function getAllSkills(){
		return Skill::all();
	}
	public function getSkillById($id){
		return Skill::find($id);
	}
	public function createOrUpdate($id = null, $collection = []){


		if(is_null($id)){
			$skills = new Skill();
		}else{
			$skills = Skill::find($id);
		}
		$skills->name = $collection['name'];
		$skills->description = isset($collection['description']) ? $collection['description'] : null;
		$skills->status = isset($collection['status']) ? $collection['status'] : 1;
		$skills->created_by = auth()->user()->id;
		return $skills->save();
	}
	public function deleteSkill($id){
		return Skill::find($id)->delete();
	}

	public function deleteMultipleSkills($collection = []){

		 if (isset($collection['ids']) && !empty($collection['ids'])) {
            foreach ($collection['ids'] as $key => $value) {
                 $id = base64_decode($value);
                 $this->deleteSkill($id);
             } 
        }
        return true;
	}

}