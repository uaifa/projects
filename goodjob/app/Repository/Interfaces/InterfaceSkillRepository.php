<?php


namespace App\Repository\Interfaces;

Interface InterfaceSkillRepository{

	public function getAllSkills();
	public function getSkillById($id);
	public function createOrUpdate($id = null, $collection = []);
	public function deleteSkill($id);
	public function deleteMultipleSkills($collection = []);

}