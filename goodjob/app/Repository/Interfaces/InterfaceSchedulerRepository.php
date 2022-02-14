<?php


namespace App\Repository\Interfaces;

Interface InterfaceSchedulerRepository{

	public function getAllSchedulers();
	public function getSchedulerById($id);
	public function createOrUpdate($id = null, $collection = []);
	public function deleteScheduler($id);
	public function deleteMultiplechedulers($collection = []);

}