<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;


class PackagesController extends Controller
{
    public function index(){

        $packages = Package::latest()->get();

        return view('website.pages.packages.index', compact('packages'));
    }
}
