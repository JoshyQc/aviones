<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Aeropuerto;

class AeropuertoController extends Controller
{
    public function index(){
        $database -> $this->initFirebase();
        $aeropuertos = $database->getReference('aeropuertos')->getValue();
        
        $parced_array  = array();
        foreach ($aeropuertos as $key => $value){
            array_push($parced_array, ['id'=>$key, 'nombre' => $value['nombre'], 'localidad' => $value['localidad'], 'pais' => $value['pais']]);
    }


        return $parced_array;
    }

    public function storeApi(Request $request){
    	$aeropuerto = new Aeropuerto;
    	$aeropuerto-> nombre =$request->nombre;
    	$aeropuerto-> localidad = $request->localidad;
    	$aeropuerto-> pais = $request->pais;
    	$aeropuerto-> save();
    	return json_encode(true);  
    }

    //ADMIN

    public function store(Request $request){
    	$database = $this->initFirebase();
        $new = $database
        ->getReference('aeropuertos')
        ->push([
            'nombre' => $request->nombre,
            'localidad' => $request->localidad,
            'pais' => $request->pais
        ]);
        return redirect('/aeropuerto');
    }

    public function edit($id){
    	$aeropuerto = Aeropuerto::find($id);
        $database = $this->initFirebase();
        $aeropuerto = $database->getReference('aeropuertos/'.$id)->getValue();
        return view('update_aeropuerto', ['aeropuerto'=> json_decode(json_encode( ['id'=>$id, 'nombre'=>$aeropuerto['nombre'],'localidad'=>$aeropuerto['localidad'],'pais'=>$aeropuerto['pais']] )) ]);
    }

    public function home(){

     $database = $this->initFirebase();

        $aeropuertos = $database->getReference('aeropuertos')->getValue();
        
        $parced_array  = array();
        foreach ($aeropuertos as $key => $value){
            array_push( $parced_array, json_decode(json_encode(  ['id'=>$key, 'nombre' => $value['nombre'],'localidad' => $value['localidad'],'pais' => $value['pais']] )) );
        }

        return view('aeropuerto',['aeropuertos'=>$parced_array]);
    }

    public function getAll(){
        $aeropuerto = Aeropuerto::all();
        return redirect('/vuelo');
    }

    public function delete(Request $request){
    	$database = $this->initFirebase();
        $database->getReference('aeropuertos/'. $request->id)->remove();
        return redirect('/aeropuerto');
    }

    public function update(Request $request){
    	$database = $this->initFirebase();
        $database->getReference('aeropuertos/'. $request->id)->set([
            'nombre' => $request->nombre,
            'localidad' => $request->localidad,
            'pais' => $request->pais
        ]);         
        return redirect('/aeropuerto');
    }
}
