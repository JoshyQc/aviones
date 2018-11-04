<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Embarque;
use App\Cliente;

class EmbarqueController extends Controller
{
    public function home(){
    	return view('embarque', ['embarques'=>Embarque::all(),'clientes'=>Cliente::all()]);
    }

}
