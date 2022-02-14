<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobListRequest;
use App\Models\Client;
use App\Models\JobsList;
use App\Repository\Interfaces\InterfaceJobListRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
    public function index()
    {
        $jobs_lists = [];
        $result = JobsList::orderBy('date','DESC')->get();
        if($result){
            foreach ($result as $key => $value) {
                $jobs_lists[$value->date][] = $value;
            }
        }
        if (request()->ajax()) {
            $data = JobsList::latest();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<td>';
                    $destroy_url = "'" . route('joblists.destroy', base64_encode($row->id)) . "'";
                    $cat_id = $row->id;
                        $btn .= '<a class="btn btn-info btn-xs" href="' . route('joblists.show', base64_encode($row->id)) . '"><i class="fa fa-eye"></i></a>';
                        $btn .= ' <a class="btn btn-primary btn-xs" href="' . route('joblists.edit', base64_encode($row->id)) . '"><i class="fa fa-pencil"></i></a>';
                        $btn .= ' <button class="btn btn-danger btn-xs" type="button" onclick="alertify_func(' . $cat_id . ',' . $destroy_url . ');"><i class="fa fa-trash"></i></button>
                        </td>';

                    // return  $btn;
                    $edit_icon = asset('assets/images/icon-edit.png');
                    return '<td>
                                <a href="'.route('joblists.edit', base64_encode($row->id)) .'">
                                    <img src="'.$edit_icon.'">
                                </a>
                            </td>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.joblists.index', compact('jobs_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = __('messages.add_jobs');
        $id = (isset(request()->id) && !empty(request()->id)) ? request()->id : null;
        $joblists = !is_null($id) ? $this->joblist->getJobListById(base64_decode($id)) : '';
        $roles = Role::latest()->get();
        $clients = Client::latest()->get();
        return view('admin.pages.joblists.create-update', compact('clients', 'joblists', 'roles', 'page_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobListRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        $this->joblist->createOrUpdate(null,$collection);
        smilify('success', __('messages.record_saved_successfully'));
        return redirect()->route('joblists.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_name = __('messages.update_jobs');
        $joblists = $this->joblist->getJobListById(base64_decode($id));
        $clients = Client::latest()->get();
        $roles = Role::latest()->get();
        return view('admin.pages.joblists.create-update', compact('joblists', 'clients', 'roles', 'page_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_name = __('messages.update_jobs');
        $joblists = $this->joblist->getJobListById(base64_decode($id));
        $clients = Client::latest()->get();
        $roles = Role::latest()->get();
        return view('admin.pages.joblists.create-update', compact('joblists', 'clients', 'roles', 'page_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobListRequest $request, $id)
    {
        $collection = $request->except(['_token','_method']);
        $this->joblist->createOrUpdate(base64_decode($id), $collection);
        smilify('success', __('messages.record_update_successfully'));
        return redirect()->route('joblists.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->joblist->deleteJobList(base64_decode($id));
        smilify('success', __('messages.record_delete_successfully'));
        return redirect()->route('joblists.index');
    }

    public function delete(){
        
        $result = $this->joblist->deleteMultipleJobLists(request()->all());

        smilify('success', __('messages.record_delete_successfully'));

        return $result;
        
    }
}
