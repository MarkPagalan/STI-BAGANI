<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Waterlevel;
use App\User;
use Auth;

class WaterlevelController extends Controller
{
    public function uploadWater(Request $request)  {
    	//dd(auth()->user());
    	//return $request->all();

    	$waterlevel = new Waterlevel;
    	$waterlevel->waterlevel = $request->water;
    	$waterlevel->user_id = Auth::user()->id;
    	$waterlevel->save();

    	$message = array(
           'message'=>  "success"
        );
       return response()->json($message);

    }
}