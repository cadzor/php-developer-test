<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Picture;

class PictureController extends Controller
{
    public function index() {

        $today = Carbon::today()->format('Y-m-d');
        $potd = Picture::where('date', $today)->first();

        if (empty($potd)) {
            $potd = Picture::orderBy('date', 'desc')->first();
        }
        
        $otherPics = Picture::orderBy('date', 'desc')->where('date', '!=', $potd->date)->simplePaginate(3);
    
        return view('index', compact('potd', 'otherPics'));
    }

    public function show($id) {
        $picture = Picture::findOrFail($id);
        return view('show', compact('picture'));
    }

}
