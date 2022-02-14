<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImage extends Controller
{
    public function __invoke($request, $path)
    {

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->StoreAs('public/' . $path, $imageName);
        // $returnPath = $path . '/' . $name;

        return $imageName;
    }
}
