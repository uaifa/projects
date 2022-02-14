<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;


class PDFController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Welcome to Goodjob',
            'date' => date('m/d/Y')
        ];
           
        $pdf = PDF::loadView('test-pdf', $data);
     
        return $pdf->download('example-'.time().'-.pdf');
    }

}
