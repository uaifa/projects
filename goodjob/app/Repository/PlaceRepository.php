<?php 

namespace App\Repository;

use App\Models\Place;
use App\Repository\Interfaces\InterfacePlaceRepository;

class PlaceRepository implements InterfacePlaceRepository{

	protected $places = null;

	public function getAllPlaces(){
		return Place::all();
	}
	public function getPlaceById($id){
		return Place::find($id);
	}
	public function createOrUpdate($id = null, $collection = []){


		if(is_null($id)){
			$place = new Place();
		}else{
			$place = Place::find($id);
		}
		$place->job_title = $collection['job_title'];
		$place->distance = $collection['distance'];
		$place->client_id = $collection['client_id'];
		$place->description = $collection['description'];
		$place->scheduled = $collection['scheduled'];
		$place->assign_to = $collection['assign_to'];
		$place->status = $collection['status'];
		$place->created_by = auth()->user()->id;
		return $place->save();
	}
	public function deletePlace($id){
		return Place::find($id)->delete();
	}
	
	public function deleteMultiplePlaces($collection = []){

		 if (isset($collection['ids']) && !empty($collection['ids'])) {
            foreach ($collection['ids'] as $key => $value) {
                 $id = base64_decode($value);
                 $this->deletePlace($id);
             } 
        }
        return true;
	}
}