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
    	$vuelo = new Vuelo;
    	$vuelo-> fecha_salida = $request->fecha_salida;
    	$vuelo-> fecha_llegada = $request->fecha_llegada;
    	$vuelo-> id_salida_aeropuerto = $request->id_salida_aeropuerto;
    	$vuelo-> id_llegada_aeropuerto = $request->id_llegada_aeropuerto;


    	$vuelo->save();
    	return redirect('/vuelo');
    }

    public function edit($id){
        $vuelo = Vuelo::find($id);
        return view('update_vuelo', ['vuelo'=> $vuelo,'aeropuertos'=>Aeropuerto::all()]);
    }

    public function home(){
    	return view(
    		'vuelo',['vuelos'=>Vuelo::all(), 
    		'aeropuertos'=>Aeropuerto::all()
    	]);
    }

    public function delete(Request $request){
    	$vuelo = Vuelo::find($request->id);
    	$vuelo->delete();
    	return redirect('/vuelo');
    }

    public function update(Request $request){
    	//$aeropuertos = Aeropuerto::all();
    	$vuelo = Vuelo::find($request->id);
    	$vuelo-> fecha_salida = $request->fecha_salida;
    	$vuelo-> fecha_llegada = $request->fecha_llegada;
    	$vuelo-> id_salida_aeropuerto = $request->id_salida_aeropuerto;
    	$vuelo-> id_llegada_aeropuerto = $request->id_llegada_aeropuerto;

    	$vuelo->save();
    	return redirect('/vuelo');
    }

    public function AeropuertoSalida(){
    	return $this->hasOne('App\Aeropuerto', 'id', 'id_salida_aeropuerto');
    }

    public function aeropuertoLlegada(){
    	return $this->hasOne('App\Aeropuerto', 'id', 'id_llegada_aeropuerto');
    }

}
