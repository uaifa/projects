<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffMemberRequest;
use App\Repository\Interfaces\InterfaceStaffMemberRepository;
use Illuminate\Http\Request;

class StaffMemberController extends Controller
{
    public $staff_members;
    
    public function __construct(InterfaceStaffMemberRepository $staff_members)
    {
        $this->staff_members = $staff_members;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language = 'en')
    {
        if($staff_members = $this->staff_members->getAllStaffMembers())
            return sendSuccessResponse(__('messages.staff_members_list'), $staff_members);
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
    public function store($language = 'en', StaffMemberRequest $request)
    {
        $collection = $request->except(['_token','_method']);

        if($result = $this->staff_members->createOrUpdate(null,$collection))
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
        if(!$this->staff_members->getStaffMemberById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($staff_members = $this->staff_members->getStaffMemberById($id))
            return sendSuccessResponse(__('messages.staff_member_detail'), $staff_members);
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
        if(!$this->staff_members->getStaffMemberById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($staff_members = $this->staff_members->getStaffMemberById($id))
            return sendSuccessResponse(__('messages.staff_member_detail'), $staff_members);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($language = 'en', StaffMemberRequest $request, $id)
    {
        if(!$this->staff_members->getStaffMemberById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        $collection = $request->except(['_token','_method']);
        if($result = $this->staff_members->createOrUpdate($id, $collection))
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
        if(!$this->staff_members->getStaffMemberById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($result = $this->staff_members->deleteStaffMember($id))
            return sendSuccessResponse(__('messages.record_delete_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    public function upload_profile_image($language = 'en', $id, Request $request){
        if(!$this->staff_members->getStaffMemberById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        $collection = $request->all();
        if($result = $this->staff_members->uploadProfileImage($id,$collection))
            return sendSuccessResponse(__('messages.profile_image_upload_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }
}
