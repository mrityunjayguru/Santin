<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadArtController extends Controller
{
    //

    public function index(Request $request){

        return view('download-art.index');
    }
}
