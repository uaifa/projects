<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    
    public function import(){

        Excel::import(new UsersImport,request()->file('import_file'));

        smilify('success', 'The file has been imported successfully ');
        
        return true;
    }
}
