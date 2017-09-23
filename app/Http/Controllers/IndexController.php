<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function hola(){
    	return "hola desde el controlador";
    }
}
