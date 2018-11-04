<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Avion;

class AvionController extends Controller{

	public function index(){
		return Avion::all();
	}

	public function storeApi(Request $request){
		$avion = new Avion;
		$avion-> plaza = $request->plaza;
		$avion-> save();
		return json_encode(true);
	}



	//ADMIN

	public function store(Request $request){
		$avion = new Avion;
		$avion-> plaza = $request->plaza;
		$avion-> save();
		return redirect('/avion');
	}

	 public function edit($id){
    	$avion = Avion::find($id);
    	return view('update_avion', ['avion'=> $avion]);
    }

	public function home(){
		return view('avion',['aviones'=>Avion::all()]);
	}

	public function delete(Request $request){
		$avion = Avion::find($request->id);
		$avion->delete();
		return redirect('/avion');
	}

	public function update(Request $request){
		$avion = Avion::find($request->id);
		$avion-> plaza = $request->plaza;
		$avion->save();

		return redirect('/avion');
	}

}