<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Repository\Interfaces\InterfacePackageRepository;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public $package;
    
    public function __construct(InterfacePackageRepository $package)
    {
        $this->package = $package;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language = 'en')
    {
        
        if($packages = $this->package->getAllPackages())
            return sendSuccessResponse(__('messages.packages_list'), $packages);
    
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
    public function store($language = 'en', PackageRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        if($result = $this->package->createOrUpdate(null,$collection))
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
        if(!$this->package->getpackageById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($packages = $this->package->getpackageById($id))
            return sendSuccessResponse(__('messages.packages_list_detail'), $packages);
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
        if(!$this->package->getpackageById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($packages = $this->package->getpackageById($id))
            return sendSuccessResponse(__('messages.packages_list_detail'), $packages);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($language = 'en', PackageRequest $request, $id)
    {
        if(!$this->package->getpackageById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        $collection = $request->except(['_token','_method']);
        if($result = $this->package->createOrUpdate($id, $collection))
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
        if(!$this->package->getpackageById($id)){
            return sendSuccessResponse(__('messages.record_not_found'), []);
        }
        if($result = $this->package->deletepackage($id))
            return sendSuccessResponse(__('messages.record_delete_successfully'), $result);
        return sendErrorResponse(__('messages.something_went_wrong'));
    }
}
