<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Vuelo;
use App\Aeropuerto;

class VueloController extends Controller
{
    public function index(){
    	$vuelo = DB::table('vuelo')
            ->join("aeropuerto as salida", 'id_salida_aeropuerto', '=', 'salida.id')
            ->join("aeropuerto as llegada", 'id_llegada_aeropuerto', '=', 'llegada.id')
            ->select('vuelo.*', 'llegada.nombre as llegada_nombre', 'llegada.pais as llegada_pais', 'salida.nombre as salida_nombre', 'llegada.pais as salida_pais')
            ->get();
    	return $vuelo;
    }

    public function storeApi(Request $request){
    	$vuelo = new Vuelo;
    	$vuelo-> fecha_salida = $request->fecha_salida;
    	$vuelo-> fecha_llegada = $request->fecha_llegada;
    	$vuelo-> id_salida_aeropuerto = $request->id_salida_aeropuerto;
    	$vuelo-> id_llegada_aeropuerto = $request->id_llegada_aeropuerto;

    	$vuelo->save();
    	return json_encode(true);
    }

    //ADMIN

    public function store(Request $request){

		$database = $this->initFirebase();
        $new = $database
        ->getReference('vuelos')
        ->push([
            'fecha_salida' => $request->fecha_salida,
            'fecha_llegada' => $request->fecha_llegada,
			'id_salida_aeropuerto' => $request->id_salida_aeropuerto,
			'id_llegada_aeropuerto' => $request->id_llegada_aeropuerto
        ]);
    	return redirect('/vuelo');
    }

    public function edit($id){
		$database = $this->initFirebase();
        $vuelo = $database->getReference('vuelos/'.$id)->getValue();
		
		$aeropuertos = $database->getReference('aeropuertos')->getValue();
		$parced_aeropuertos  = array();
        foreach ($aeropuertos as $key => $value){
            array_push($parced_aeropuertos, ['id'=>$key, 'nombre' => $value['nombre'], 'localidad' => $value['localidad'], 'pais' => $value['pais']]);
		}

      	return view('update_vuelo', [
			'vuelo'=> [					
				'id' => $id,
				'fecha_salida' => $vuelo['fecha_salida'],
				'fecha_llegada' => $vuelo['fecha_llegada'],
				'id_salida_aeropuerto' => $vuelo['id_salida_aeropuerto'],
				'id_llegada_aeropuerto' => $vuelo['id_llegada_aeropuerto']	
			],
			'aeropuertos'=>$parced_aeropuertos
		]);
    }

    public function home(){

		$database = $this->initFirebase();
		$aeropuertos = $database->getReference('aeropuertos')->getValue();
		$vuelos = $database->getReference('vuelos')->getValue();
		if(is_null($vuelos)){
			$vuelos = array();
		}

		
        $parced_aeropuertos  = array();
        foreach ($aeropuertos as $key => $value){
            array_push($parced_aeropuertos, ['id'=>$key, 'nombre' => $value['nombre'], 'localidad' => $value['localidad'], 'pais' => $value['pais']]);
		}

		$parced_vuelos = array();
		foreach($vuelos as $key => $value){
			array_push($parced_vuelos, [
				'id' => $key, 
				'fecha_salida' => $value['fecha_salida'],
				'fecha_llegada' => $value['fecha_llegada'],
				'id_salida_aeropuerto' => $value['id_salida_aeropuerto'],
				'id_llegada_aeropuerto' => $value['id_llegada_aeropuerto']
			]);
		}

    	return view('vuelo',['vuelos'=>$parced_vuelos, 'aeropuertos'=>$parced_aeropuertos]);
    }

    public function delete(Request $request){
		$database = $this->initFirebase();
        $database->getReference('vuelos/'. $request->id)->remove();
    	return redirect('/vuelo');
    }

    public function update(Request $request){
    
		$database = $this->initFirebase();
        $database->getReference('vuelos/'. $request->id)->set([
            'fecha_salida' => $request->fecha_salida,
            'fecha_llegada' => $request->fecha_llegada,
			'id_salida_aeropuerto' => $request->id_salida_aeropuerto,
			'id_llegada_aeropuerto' => $request->id_llegada_aeropuerto
        ]);        

    	return redirect('/vuelo');
    }

    public function AeropuertoSalida(){
    	return $this->hasOne('App\Aeropuerto', 'id', 'id_salida_aeropuerto');
    }

    public function aeropuertoLlegada(){
    	return $this->hasOne('App\Aeropuerto', 'id', 'id_llegada_aeropuerto');
    }

}
