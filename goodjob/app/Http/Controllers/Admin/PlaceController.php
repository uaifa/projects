<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Models\Client;
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
        if (request()->ajax()) {
            $data = Place::latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<td>';
                    $destroy_url = "'" . route('places.destroy', base64_encode($row->id)) . "'";
                    $cat_id = $row->id;
                        $btn .= '<a class="btn btn-info btn-xs" href="' . route('places.show', base64_encode($row->id)) . '"><i class="fa fa-eye"></i></a>';
                        $btn .= ' <a class="btn btn-primary btn-xs" href="' . route('places.edit', base64_encode($row->id)) . '"><i class="fa fa-pencil"></i></a>';
                        $btn .= ' <button class="btn btn-danger btn-xs" type="button" onclick="alertify_func(' . $cat_id . ',' . $destroy_url . ');"><i class="fa fa-trash"></i></button>
                        </td>';

                    // return  $btn;
                    $edit_icon = asset('assets/images/icon-edit.png');
                    return '<td>
                                <a href="'.route('places.edit', base64_encode($row->id)) .'">
                                    <img src="'.$edit_icon.'">
                                </a>
                            </td>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.places.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id = (isset(request()->id) && !empty(request()->id)) ? request()->id : null;
        $places = !is_null($id) ? $this->place->getPlaceById(base64_decode($id)) : '';
        $clients = Client::latest()->get();
        return view('admin.pages.places.create-update', compact('places', 'clients'));
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
        $this->place->createOrUpdate(null,$collection);
        smilify('success', __('messages.record_saved_successfully'));
        return redirect()->route('places.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $places = $this->place->getPlaceById(base64_decode($id));
        $clients = Client::latest()->get();
        return view('admin.pages.places.create-update', compact('places', 'clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $places = $this->place->getPlaceById(base64_decode($id));
        $clients = Client::latest()->get();
        return view('admin.pages.places.create-update', compact('places', 'clients'));
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
        $this->place->createOrUpdate(base64_decode($id), $collection);
        smilify('success', __('messages.record_update_successfully'));
        return redirect()->route('places.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->place->deletePlace(base64_decode($id));
        smilify('success', __('messages.record_delete_successfully'));
        return redirect()->route('places.index');
    }

    public function delete(){
        
        $result = $this->place->deleteMultiplePlaces(request()->all());

        smilify('success', __('messages.record_delete_successfully'));

        return $result;
        
    }
}
