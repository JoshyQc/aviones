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

        $database = $this->initFirebase();
        $cliente = $database
        ->getReference('clientes')
        ->push([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion
        ]);
        
        $reserva = $database->getReference('reservas')
        ->push([
            'fecha' =>  DB::raw('now()'),
            'id_cliente' => $cliente->getKey()
        ]);
        
        $embarques = $database->getReference('embarques')->getValue();
        $ultimoEmbarque = null;
        if(!is_null($embarques)){
            $embarques_array  = array();
            foreach ($embarques as $key => $value){
                array_push($embarques_array, [
                    'id'=>$key, 
                    'asiento' => $value['asiento'],
                    'id_vuelo' => $value['id_vuelo'],
                    'id_reserva' => $value['id_reserva'],
                    'id_cliente' => $value['id_cliente'],
                ]);
            }
            $ultimoEmbarque = end($embarques_array);
        }
        if(is_null($ultimoEmbarque)){
            $asiento  =  "A-1";
        }else{
            $letra = explode("-", $ultimoEmbarque['asiento'])[0];
            $numero = explode("-", $ultimoEmbarque['asiento'])[1];

            if($numero > 9){
                $letra++;
                $numero = 1;
            }else{
                $numero++;
            }
            $asiento =  $letra."-".$numero;
        }

        $embarque = $database->getReference('embarques')
        ->push([
            'asiento' => $asiento,
            'id_vuelo' => $request->id_vuelo,
            'id_reserva' => $reserva->getKey(),
            'id_cliente' => $cliente->getKey(),
        ]);


        $vuelo = $database->getReference('vuelos/' . $request->id_vuelo)->getValue();
        $salida = $database->getReference('aeropuertos/' . $vuelo['id_salida_aeropuerto'])->getValue();
        $llegada = $database->getReference('aeropuertos/' . $vuelo['id_llegada_aeropuerto'])->getValue();

    	return json_encode(['embarque' => $embarque->getValue(), 'cliente' => $cliente->getValue(), 'vuelo' => $vuelo, 'salida' => $salida, 'llegada' => $llegada]);
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

