<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreateFolders extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($folder)
    {
        $today = Carbon::now();
        $createFolderPath = $folder . '/' . $today->year . '/' . $today->month . '/' . $today->day . '/';
        Storage::makeDirectory($createFolderPath);
        return $createFolderPath;
    }
}
