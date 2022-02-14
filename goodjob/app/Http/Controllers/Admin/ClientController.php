<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repository\Interfaces\InterfaceClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public $client;
    
    public function __construct(InterfaceClientRepository $client)
    {
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Client::latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<td>';
                    $destroy_url = "'" . route('clients.destroy', base64_encode($row->id)) . "'";
                    $cat_id = $row->id;
                        $btn .= '<a class="btn btn-info btn-xs" href="' . route('clients.show', base64_encode($row->id)) . '"><i class="fa fa-eye"></i></a>';
                        $btn .= ' <a class="btn btn-primary btn-xs" href="' . route('clients.edit', base64_encode($row->id)) . '"><i class="fa fa-pencil"></i></a>';
                        $btn .= ' <button class="btn btn-danger btn-xs" type="button" onclick="alertify_func(' . $cat_id . ',' . $destroy_url . ');"><i class="fa fa-trash"></i></button>
                        </td>';

                    // return  $btn;
                    $edit_icon = asset('assets/images/icon-edit.png');
                    return '<td>
                                <a href="'.route('clients.edit', base64_encode($row->id)) .'">
                                    <img src="'.$edit_icon.'">
                                </a>
                            </td>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = (isset(request()->id) && !empty(request()->id)) ? request()->id : null;
        $clients = !is_null($id) ? $this->client->getClientById(base64_decode($id)) : '';

        return view('admin.pages.clients.create-update', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        $this->client->createOrUpdate(null,$collection);

        smilify('success', __('messages.record_saved_successfully'));

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clients = $this->client->getClientById(base64_decode($id));
        return view('admin.pages.clients.create-update', compact('clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = $this->client->getClientById(base64_decode($id));
        return view('admin.pages.clients.create-update', compact('clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $collection = $request->except(['_token','_method']);
        $this->client->createOrUpdate(base64_decode($id), $collection);
        smilify('success', __('messages.record_update_successfully'));
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->client->deleteClient(base64_decode($id));

        smilify('success', __('messages.record_delete_successfully'));

        return redirect()->route('clients.index');
    }

    public function delete(){
        
        $result = $this->client->deleteMultipleClients(request()->all());

        smilify('success', __('messages.record_delete_successfully'));
        
        return $result;
        
    }
}
