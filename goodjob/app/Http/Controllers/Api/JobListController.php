<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobListRequest;
use App\Models\Client;
use App\Models\JobsList;
use App\Repository\Interfaces\InterfaceJobListRepository;
use Illuminate\Http\Request;

class JobListController extends Controller
{
    public $joblist;
    
    public function __construct(InterfaceJobListRepository $joblist)
    {
        $this->joblist = $joblist;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language = 'en')
    {
        if($joblists = $this->joblist->getAllJobLists())
            return sendSuccessResponse(__('messages.joblist_list'), $joblists);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($language = 'en')
    {
        if($clients = Client::latest()->get())
            return sendSuccessResponse(__('messages.clients_list'), $clients);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($language = 'en', JobListRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        if($result = $this->joblist->createOrUpdate(null,$collection))
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
        if(!$this->joblist->getJobListById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        $joblists = $this->joblist->getJobListById($id);
        $clients = Client::latest()->get();
        if($joblists){
            $data['clients'] = $clients;
            $data['joblists'] = $joblists;
            return sendSuccessResponse(__('messages.joblists_list_detail'), $data);
        }
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
        if(!$this->joblist->getJobListById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        $joblists = $this->joblist->getJobListById($id);
        $clients = Client::latest()->get();
        if($joblists){
            $data['clients'] = $clients;
            $data['joblists'] = $joblists;
            return sendSuccessResponse(__('messages.joblists_list_detail'), $data);
        }
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($language = 'en', JobListRequest $request, $id)
    {
        if(!$this->joblist->getJobListById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        $collection = $request->except(['_token','_method']);
        if($result = $this->joblist->createOrUpdate($id, $collection))
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
        if(!$this->joblist->getJobListById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($result = $this->joblist->deleteJobList($id))
            return sendSuccessResponse(__('messages.record_delete_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }
}
