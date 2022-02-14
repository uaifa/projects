<?php


namespace App\Repository\Interfaces;

Interface InterfacePackageRepository{

	public function getAllPackages();
	public function getPackageById($id);
	public function createOrUpdate($id = null, $collection = []);
	public function deletePackage($id);
	public function deleteMultiplePackages($collection = []);

}