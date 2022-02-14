<?php


namespace App\Repository\Interfaces;

Interface InterfaceContactPersonRepository{

	public function getAllContactPerson();
	public function getContactPersonById($id);
	public function createOrUpdate($id = null, $collection = []);
	public function deleteContactPerson($id);

}