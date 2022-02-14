<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\Package;
use App\Repository\Interfaces\InterfacePackageRepository;
use Illuminate\Http\Request;
use App\Models\Currency;

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
    public function index()
    {
        if (request()->ajax()) {
            $data = Package::latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<td>';
                    $destroy_url = "'" . route('packages.destroy', base64_encode($row->id)) . "'";
                    $cat_id = $row->id;
                        $btn .= '<a class="btn btn-info btn-xs" href="' . route('packages.show', base64_encode($row->id)) . '"><i class="fa fa-eye"></i></a>';
                        $btn .= ' <a class="btn btn-primary btn-xs" href="' . route('packages.edit', base64_encode($row->id)) . '"><i class="fa fa-pencil"></i></a>';
                        $btn .= ' <button class="btn btn-danger btn-xs" type="button" onclick="alertify_func(' . $cat_id . ',' . $destroy_url . ');"><i class="fa fa-trash"></i></button>
                        </td>';

                    // return  $btn;
                     $edit_icon = asset('assets/images/icon-edit.png');
                    return '<td>
                                    <a href="'.route('packages.edit', base64_encode($row->id)) .'">
                                        <img src="'.$edit_icon.'">
                                    </a>
                                </td>';

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.packages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = (isset(request()->id) && !empty(request()->id)) ? request()->id : null;
        $packages = !is_null($id) ? $this->package->getpackageById(base64_decode($id)) : '';

        $currencies = Currency::orderBy('code','ASC')->get();
        return view('admin.pages.packages.create-update', compact('currencies', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $collection = $request->except(['_token','_method']);
        $this->package->createOrUpdate(null,$collection);

        smilify('success', __('messages.record_saved_successfully'));
        return redirect()->route('packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currencies = Currency::orderBy('code','ASC')->get();
        $packages = $this->package->getpackageById(base64_decode($id));
        return view('admin.pages.packages.create-update', compact('packages', 'currencies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currencies = Currency::orderBy('code','ASC')->get();
        $packages = $this->package->getpackageById(base64_decode($id));
        return view('admin.pages.packages.create-update', compact('packages', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
    {
        $collection = $request->except(['_token','_method']);
        $this->package->createOrUpdate(base64_decode($id), $collection);
        smilify('success', __('messages.record_update_successfully'));
        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->package->deletepackage(base64_decode($id));
        smilify('success', __('messages.record_delete_successfully'));
        return redirect()->route('packages.index');
    }

    public function delete(){
        
        $result = $this->package->deleteMultiplePackages(request()->all());

        smilify('success', __('messages.record_delete_successfully'));

        return $result;
        
    }
}
