<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Picture;

class PictureController extends Controller      
{
    public function index() {

        // Get the picture of the day, if today hasn't been uploaded yet, get last
        $today = Carbon::today()->format('Y-m-d');
        $potd = Picture::where('date', $today)->first();

        if (empty($potd)) {
            $potd = Picture::orderBy('date', 'desc')->first();
        }
        
        // Get 30 pictures in desc order (date) which isn't the current POTD
        $otherPics = Picture::where('date', '!=', $potd->date)->orderBy('date', 'desc')->take(30)->get();

        return view('index', compact('potd', 'otherPics'));
    }

    public function show($id) {
        $picture = Picture::findOrFail($id);
        return view('show', compact('picture'));
    }

}
