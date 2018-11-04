<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Reserva;
use App\Cliente;
use App\Embarque;
use App\Vuelo;
use App\Aeropuerto;

class ClienteController extends Controller
{
    public function index(){
    	return Cliente::all();
    }

    

    public function storeApi(Request $request){

    	$cliente = new Cliente;
    	$cliente-> dni = $request->dni;
    	$cliente-> nombre = $request->nombre;
    	$cliente-> apellido = $request->apellido;
    	$cliente-> telefono = $request->telefono;
    	$cliente-> direccion = $request->direccion; 
    	$cliente-> save();

        $reserva = new Reserva;
        $reserva-> fecha = DB::raw('now()');
        $reserva-> id_cliente = $cliente -> id;
        $reserva->save();

        $ultimoEmbarque = Embarque::all()->last();


        if(is_null($ultimoEmbarque)){
            $asiento  =  "A-1";
        }else{
            $letra = explode("-", $ultimoEmbarque->asiento)[0];
            $numero = explode("-", $ultimoEmbarque->asiento)[1];

            if($numero > 9){
                $letra++;
                $numero = 1;
            }else{
                $numero++;
            }
            $asiento =  $letra."-".$numero;
        }
        
        $embarque = new Embarque;
        $embarque->asiento = $asiento;
        $embarque->id_vuelo = $request->id_vuelo;
        $embarque->id_reserva = $reserva->id;
        $embarque->id_cliente = $cliente->id;  
        $embarque->save();

        $vuelo = Vuelo::find($request->id_vuelo);

        $salida = Aeropuerto::find($vuelo->id_salida_aeropuerto);
        $llegada = Aeropuerto::find($vuelo->id_llegada_aeropuerto);

    	return json_encode(['embarque' => $embarque, 'cliente' => $cliente, 'vuelo' => $vuelo, 'salida' => $salida, 'llegada' => $llegada]);
    }




    //ADMIN

    public function store(Request $request){
    	$cliente = new Cliente;
    	$cliente-> dni = $request->dni;
    	$cliente-> nombre = $request->nombre;
    	$cliente-> apellido = $request->apellido;
    	$cliente-> telefono = $request->telefono;
    	$cliente-> direccion = $request->direccion; 
    	$cliente-> save();
    	return redirect('/cliente');
    	//return view('cliente', ['clientes'=>Cliente::all()]);
    }

    public function edit($id){
    	$cliente = Cliente::find($id);

    	return view('update_cliente', ['cliente'=> $cliente]);
    }

    public function home(){
    	return view('cliente', ['clientes'=>Cliente::all()]);
    }

    public function delete(Request $request){
    	$client = Cliente::find($request->id);
    	$client->delete();
    	return redirect('/cliente');
    }

    public function update(Request $request){
    	$cliente = Cliente::find($request->id);
    	$cliente->dni = $request->dni;
    	$cliente-> nombre = $request->nombre;
    	$cliente-> apellido = $request->apellido;
    	$cliente-> telefono = $request->telefono;
    	$cliente-> direccion = $request->direccion; 

    	$cliente->save();


    	return redirect('/cliente');


    }
}

