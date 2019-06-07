<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SistemasController extends Controller
{
    public function getSistema(){
    	return "get Index";
    }

    public function postSistema(){
    	return Input::all();
    }
}
