<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function __construct()
    {
        //
    }

     public function index(){
    	return "Hola desde el controlador";
    }

     public function index2(){
     	return "nada";
     }
}
