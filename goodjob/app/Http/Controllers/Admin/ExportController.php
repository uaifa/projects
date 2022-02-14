<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'example-'.time().'.xlsx');
    }

    public function export_pdf(){

        $data = User::get()->toArray();
	   return Excel::create('text_example-'.time(), function($excel) use ($data) {
		$excel->sheet('mySheet', function($sheet) use ($data)
	    {
			$sheet->fromArray($data);
	    });
	   })->download("pdf");
    
    }
    
}
