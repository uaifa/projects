<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
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
    public function index($language = 'en')
    {
        if($clients = $this->client->getAllClients())
            return sendSuccessResponse(__('messages.clients_list'), $clients);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($language = 'en')
    {
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($language = 'en', ClientRequest $request)
    {
        $collection = $request->except(['_token','_method']);

        if($result = $this->client->createOrUpdate(null,$collection))
            return sendSuccessResponse(__('messages.record_saved_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($language = 'en', $id)
    {
        if(!$this->client->getClientById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($clients = $this->client->getClientById($id))
            return sendSuccessResponse(__('messages.client_detail'), $clients);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language = 'en', $id)
    {
        if(!$this->client->getClientById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($clients = $this->client->getClientById($id))
            return sendSuccessResponse(__('messages.client_detail'), $clients);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($language = 'en', ClientRequest $request, $id)
    {
        if(!$this->client->getClientById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        $collection = $request->except(['_token','_method']);
        if($result = $this->client->createOrUpdate($id, $collection))
            return sendSuccessResponse(__('messages.record_update_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($language = 'en', $id)
    {
        if(!$this->client->getClientById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($result = $this->client->deleteClient($id))
            return sendSuccessResponse(__('messages.record_delete_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }
}
