<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;

class PictureController extends Controller
{
    public function index() {

        $potd = Picture::where('date', Carbon::today()->format('Y-m-d'))->first();

    
        return view('index', compact('potd'));
    }

    public function show($pic_id) {
        $picture = Picture::where('pic_id', $pic_id)->first();

        return view('show', compact('picture'));
    }

}
