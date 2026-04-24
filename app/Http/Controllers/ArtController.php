<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtController extends Controller
{
    //

    public function index(Request $request){

        return view('art.index');
    }

    public function create(Request $request){

        return view('art.create');
    }
}
