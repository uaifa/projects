<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Repository\Interfaces\InterfaceTeamRepository;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public $team;
    
    public function __construct(InterfaceTeamRepository $team)
    {
        $this->team = $team;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language = 'en')
    {
        if($teams = $this->team->getAllTeams())
            return sendSuccessResponse(__('messages.teams_list'), $teams);
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
    public function store($language = 'en', TeamRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        if($result = $this->team->createOrUpdate(null,$collection))
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
        if(!$this->team->getTeamById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($teams = $this->team->getTeamById($id))
            return sendSuccessResponse(__('messages.teams_list_detail'), $teams);
    
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
        if(!$this->team->getTeamById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($teams = $this->team->getTeamById($id))
            return sendSuccessResponse(__('messages.teams_list_detail'), $teams);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($language = 'en', TeamRequest $request, $id)
    {

        if(!$this->team->getTeamById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        $collection = $request->except(['_token','_method']);
        if($result = $this->team->createOrUpdate($id, $collection))
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
        if(!$this->team->getTeamById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($result = $this->team->deleteTeam($id))
            return sendSuccessResponse(__('messages.record_delete_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }
}
