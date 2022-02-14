<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use App\Repository\Interfaces\InterfaceSkillRepository;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public $skills;
    
    public function __construct(InterfaceSkillRepository $skills)
    {
        $this->skills = $skills;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Skill::latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<td>';
                    $destroy_url = "'" . route('skills.destroy', base64_encode($row->id)) . "'";
                    $cat_id = $row->id;
                        $btn .= '<a class="btn btn-info btn-xs" href="' . route('skills.show', base64_encode($row->id)) . '"><i class="fa fa-eye"></i></a>';
                        $btn .= ' <a class="btn btn-primary btn-xs" href="' . route('skills.edit', base64_encode($row->id)) . '"><i class="fa fa-pencil"></i></a>';
                        $btn .= ' <button class="btn btn-danger btn-xs" type="button" onclick="alertify_func(' . $cat_id . ',' . $destroy_url . ');"><i class="fa fa-trash"></i></button>
                        </td>';

                    // return  $btn;
                        $edit_icon = asset('assets/images/icon-edit.png');
                    return '<td>
                                    <a href="'.route('skills.edit', base64_encode($row->id)) .'">
                                        <img src="'.$edit_icon.'">
                                    </a>
                                </td>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.skills.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = (isset(request()->id) && !empty(request()->id)) ? request()->id : null;
        $skills = !is_null($id) ? $this->skills->getSkillById(base64_decode($id)) : '';

        return view('admin.pages.skills.create-update', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        $this->skills->createOrUpdate(null,$collection);

        smilify('success', __('messages.record_saved_successfully'));

        return redirect()->route('skills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skills = $this->skills->getSkillById(base64_decode($id));
        return view('admin.pages.skills.create-update', compact('skills'));
        return $skills;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skills = $this->skills->getSkillById(base64_decode($id));
        return view('admin.pages.skills.create-update', compact('skills'));
        return $skills;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SkillRequest $request, $id)
    {
        $collection = $request->except(['_token','_method']);
        $this->skills->createOrUpdate(base64_decode($id), $collection);

        smilify('success', __('messages.record_update_successfully'));

        return redirect()->route('skills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->skills->deleteSkill(base64_decode($id));
        return redirect()->route('skills.index');
    }

    public function delete(){
        
        $result = $this->skills->deleteMultipleSkills(request()->all());

        smilify('success', __('messages.record_delete_successfully'));

        return $result;
        
    }
}
