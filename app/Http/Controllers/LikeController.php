<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;

class LikeController extends Controller
{
    /* Commented out for later addition
    
    public function store(Picture $picture) {

        $picture->like(current_user());

        return back();
    }

    public function destroy (Picture $picture) {

        $picture->dislike(current_user());

        return back();
    }
    */
}
