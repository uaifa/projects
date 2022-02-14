<?php


namespace App\Repository\Interfaces;

Interface InterfacePlaceRepository{

	public function getAllPlaces();
	public function getPlaceById($id);
	public function createOrUpdate($id = null, $collection = []);
	public function deletePlace($id);
	public function deleteMultiplePlaces($collection = []);

}