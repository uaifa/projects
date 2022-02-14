<?php


namespace App\Repository\Interfaces;

Interface InterfaceClientRepository{

	public function getAllClients();
	public function getClientById($id);
	public function createOrUpdate($id = null, $collection = []);
	public function deleteClient($id);
	public function deleteMultipleClients($collection = []);

}