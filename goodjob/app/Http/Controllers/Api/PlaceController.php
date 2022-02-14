<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Models\Place;
use App\Repository\Interfaces\InterfacePlaceRepository;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public $place;
    
    public function __construct(InterfacePlaceRepository $place)
    {
        $this->place = $place;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($places = $this->place->getAllPlaces())
            return sendSuccessResponse(__('messages.places_list'), $places);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        if($result = $this->place->createOrUpdate(null,$collection))
            return sendSuccessResponse(__('messages.record_saved_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($places = $this->place->getPlaceById($id))
            return sendSuccessResponse(__('messages.places_detail'), $places);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($places = $this->place->getPlaceById($id))
            return sendSuccessResponse(__('messages.places_detail'), $places);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceRequest $request, $id)
    {
        $collection = $request->except(['_token','_method']);
        if($result = $this->place->createOrUpdate($id, $collection))
            return sendSuccessResponse(__('messages.record_update_successfully'), $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($result = $this->place->deletePlace($id))
            return sendSuccessResponse(__('messages.record_delete_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }
}
