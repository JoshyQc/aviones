<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Embarque;
use App\Cliente;

class EmbarqueController extends Controller
{
    public function home(){
        $database = $this->initFirebase();
        $embarques = $database->getReference('embarques')->getValue();
        $clientes = $database->getReference('clientes')->getValue();

        $embarques_list  = array();
        foreach ($embarques as $key => $value){
            array_push( $embarques_list, json_decode(json_encode(  ['id'=>$key, 
                'asiento' => $value['asiento'],
                'id_vuelo' => $value['id_vuelo'],
                'id_reserva' => $value['id_reserva'],
                'id_cliente' => $value['id_cliente']
            ] )) );
        }

        $clientes_list = array();
        foreach($clientes as $key => $value){
            array_push($clientes_list,json_decode(json_encode( ['id'=>$key,
                'nombre' => $value['nombre']
            ] )) );
        }

        return view('Embarque',['embarques'=>$embarques_list,'clientes'=>$clientes_list]);
    }

}
