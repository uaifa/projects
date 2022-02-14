<?php


namespace App\Repository\Interfaces;

Interface InterfaceJobListRepository{

	public function getAllJobLists();
	public function getJobListById($id);
	public function createOrUpdate($id = null, $collection = []);
	public function deleteJobList($id);
	public function deleteMultipleJobLists($collection = []);

}