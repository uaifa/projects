<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StaffMemberDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StaffMemberRequest;
use Illuminate\Http\Request;
use App\Models\StaffMember;
use App\Repository\Interfaces\InterfaceStaffMemberRepository;
use App\Models\Team;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use yajra\Datatables\Datatables;


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
    public function index(StaffMemberDataTable $datatables)
    {
        
        return $datatables->render('admin.pages.staff_members.index');  
        if (request()->ajax()) {

            $data = User::with('teams')->where('user_type', 'staffmember')->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<td>';
                    $destroy_url = "'" . route('staff-members.destroy', base64_encode($row->id)) . "'";
                    $cat_id = $row->id;
                        $btn .= '<a class="btn btn-info btn-xs" href="' . route('staff-members.show', base64_encode($row->id)) . '"><i class="fa fa-eye"></i></a>';
                        $btn .= ' <a class="btn btn-primary btn-xs" href="' . route('staff-members.edit', base64_encode($row->id)) . '"><i class="fa fa-pencil"></i></a>';
                        $btn .= ' <button class="btn btn-danger btn-xs" type="button" onclick="alertify_func(' . $cat_id . ',' . $destroy_url . ');"><i class="fa fa-trash"></i></button>
                        </td>';

                    // return  $btn;
                        $edit_icon = asset('assets/images/icon-edit.png');
                        return '<td>
                                    <a href="'.route('staff-members.edit', base64_encode($row->id)) .'">
                                        <img src="'.$edit_icon.'">
                                    </a>
                                </td>';
                })
                ->parameters([
                        'buttons' => ['postExcel', 'postCsv', 'postPdf'],
                    ])
              //   ->addIndexColumn()->parameters([
              //       'dom'          => 'Bfrtip',
              //       'buttons'      => ['export', 'print', 'reset', 'reload'],
              // ])
                    // ->make(true)
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.staff_members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = (isset(request()->id) && !empty(request()->id)) ? request()->id : null;
        $roles = Role::latest()->get();
        $teams = Team::latest()->get();
        $staff_members = !is_null($id) ? $this->staff_members->getStaffMemberById(base64_decode($id)) : '';
        // dd($staff_members);
        return view('admin.pages.staff_members.create-update', compact('teams', 'roles', 'staff_members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffMemberRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        $this->staff_members->createOrUpdate(null,$collection);
        smilify('success', __('messages.record_saved_successfully'));
        return redirect()->route('staff-members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $roles = Role::latest()->get();
        $teams = Team::latest()->get();
        $staff_members = $this->staff_members->getStaffMemberById(base64_decode($id));
        return view('admin.pages.staff_members.create-update', compact('staff_members', 'teams', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $roles = Role::latest()->get();
        $teams = Team::latest()->get();
        $staff_members = $this->staff_members->getStaffMemberById(base64_decode($id));
        return view('admin.pages.staff_members.create-update', compact('staff_members', 'teams', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffMemberRequest $request, $id)
    {
        $collection = $request->except(['_token','_method']);
        $this->staff_members->createOrUpdate(base64_decode($id), $collection);
        smilify('success', __('messages.record_update_successfully'));
        return redirect()->route('staff-members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->staff_members->deleteStaffMember(base64_decode($id));
        return redirect()->route('staff-members.index');
    }
    public function delete(){
        
        $result = $this->staff_members->deleteMultipleStffMembers(request()->all());

        smilify('success', __('messages.record_delete_successfully'));

        return $result;
        
    }
}
