<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Reserva;
use App\Cliente;
use App\Embarque;
use App\Vuelo;
use App\Aeropuerto;

class ClienteController extends Controller
{
    public function index(){
    	$clientes = $database->getReference('clientes')->getValue();
        
        $parced_array  = array();
        foreach ($clientes as $key => $value){
            array_push($parced_array, [
                'id'=>$key, 
                'dni' => $value['dni'],
                'nombre' => $value['nombre'],
                'apellido' => $value['apellido'],
                'telefono' => $value['telefono'],
                'direccion' => $value['direccion']
            ]);
    }


        return $parced_array;
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
    	$database = $this->initFirebase();
        $new = $database
        ->getReference('clientes')
        ->push([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion

        ]);
        return redirect('/cliente');
    }

    public function edit($id){
    	$cliente = Cliente::find($id);
        $database = $this->initFirebase();
        $cliente = $database->getReference('clientes/'.$id)->getValue();
        return view('update_cliente', ['cliente'=> json_decode(json_encode( ['id'=>$id,
            'dni'=>$cliente['dni'],
            'nombre'=>$cliente['nombre'],
            'apellido'=>$cliente['apellido'],
            'telefono'=>$cliente['telefono'],
            'direccion'=>$cliente['direccion']
        ] )) ]);
    }

    public function home(){
    	$database = $this->initFirebase();

        $clientes = $database->getReference('clientes')->getValue();
        
        $parced_array  = array();
        foreach ($clientes as $key => $value){
            array_push( $parced_array, json_decode(json_encode(  ['id'=>$key, 
                'dni' => $value['dni'],
                'nombre' => $value['nombre'],
                'apellido' => $value['apellido'],
                'telefono' => $value['telefono'],
                'direccion' => $value['direccion']
            ] )) );
        }

        return view('cliente',['clientes'=>$parced_array]);
    }

    public function delete(Request $request){
    	$database = $this->initFirebase();
        $database->getReference('clientes/'. $request->id)->remove();
        return redirect('/cliente');
    }

    public function update(Request $request){
    $database = $this->initFirebase();
        $database->getReference('clientes/'. $request->id)->set([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion
        ]);         
        return redirect('/cliente');


    }
}

