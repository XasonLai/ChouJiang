<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Map;

class RandomController extends Controller
{
   public function getMap(Request $request){

        $data['map'] = Map::all();

        return view('map' , $data);
    }

    public function getYou(Request $request){

    	return view('you');
    }

    public function test(){
    	$data['map'] = Map::all();
    	return view('test' , $data);
    }
}
