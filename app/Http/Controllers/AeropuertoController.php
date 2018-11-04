<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Aeropuerto;

class AeropuertoController extends Controller
{
    public function index(){
    	return Aeropuerto::all();
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
    	$aeropuerto = new Aeropuerto;
    	$aeropuerto-> nombre = $request->nombre;
    	$aeropuerto-> localidad = $request->localidad;
    	$aeropuerto-> pais = $request->pais;
    	$aeropuerto-> save();
    	return redirect('/aeropuerto');
    }

    public function edit($id){
    	$aeropuerto = Aeropuerto::find($id);
    	return view('update_aeropuerto',['aeropuerto'=> $aeropuerto]);
    }

    public function home(){
    	return view('aeropuerto',['aeropuertos'=>Aeropuerto::all()]);
    }

    public function getAll(){
        $aeropuerto = Aeropuerto::all();
        return redirect('/vuelo');
    }

    public function delete(Request $request){
    	$aeropuerto = Aeropuerto::find($request->id);
    	$aeropuerto->delete();
    	return redirect('/aeropuerto');
    }

    public function update(Request $request){
    	$aeropuerto = Aeropuerto::find($request->id);
    	$aeropuerto->nombre = $request->nombre;
    	$aeropuerto->localidad = $request->localidad;
    	$aeropuerto->pais = $request->pais;

    	$aeropuerto->save();
    	return redirect('/aeropuerto');
    }
}
