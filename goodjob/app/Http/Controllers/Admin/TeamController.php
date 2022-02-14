<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Models\Skill;
use App\Models\Team;
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
    public function index()
    {
        if (request()->ajax()) {
            $data = Team::latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<td>';
                    $destroy_url = "'" . route('teams.destroy', base64_encode($row->id)) . "'";
                    $cat_id = $row->id;
                        $btn .= '<a class="btn btn-info btn-xs" href="' . route('teams.show', base64_encode($row->id)) . '"><i class="fa fa-eye"></i></a>';
                        $btn .= ' <a class="btn btn-primary btn-xs" href="' . route('teams.edit', base64_encode($row->id)) . '"><i class="fa fa-pencil"></i></a>';
                        $btn .= ' <button class="btn btn-danger btn-xs" type="button" onclick="alertify_func(' . $cat_id . ',' . $destroy_url . ');"><i class="fa fa-trash"></i></button>
                        </td>';

                    // return  $btn;
                        $edit_icon = asset('assets/images/icon-edit.png');
                    return '<td>
                                    <a href="'.route('teams.edit', base64_encode($row->id)) .'">
                                        <img src="'.$edit_icon.'">
                                    </a>
                                </td>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.teams.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = (isset(request()->id) && !empty(request()->id)) ? request()->id : null;
        $teams = !is_null($id) ? $this->team->getTeamById(base64_decode($id)) : '';

        $skills = Skill::latest()->get();

        return view('admin.pages.teams.create-update', compact('teams', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        $this->team->createOrUpdate(null,$collection);

        smilify('success', __('messages.record_saved_successfully'));

        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teams = $this->team->getTeamById(base64_decode($id));
        $skills = Skill::latest()->get();
        return view('admin.pages.teams.create-update', compact('teams', 'skills'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teams = $this->team->getTeamById(base64_decode($id));
        $skills = Skill::latest()->get();
        return view('admin.pages.teams.create-update', compact('teams', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {
        $collection = $request->except(['_token','_method']);
        $this->team->createOrUpdate(base64_decode($id), $collection);

        smilify('success', __('messages.record_update_successfully'));

        return redirect()->route('teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->team->deleteTeam(base64_decode($id));
        return redirect()->route('teams.index');
    }

    public function delete(){
        
        $result = $this->team->deleteMultipleTeams(request()->all());

        smilify('success', __('messages.record_delete_successfully'));

        return $result;
        
    }
}
