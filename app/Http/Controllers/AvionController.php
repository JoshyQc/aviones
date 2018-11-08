<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Avion;

class AvionController extends Controller{



	public function index(){

        $aviones = $database->getReference('aviones')->getValue();
        
        $parced_array  = array();
        foreach ($aviones as $key => $value){
        	array_push($parced_array, ['id'=>$key, 'plaza' => $value['plaza']]);
  	}


		return $parced_array;
	}

	public function storeApi(Request $request){
		$avion = new Avion;
		$avion-> plaza = $request->plaza;
		$avion-> save();
		return json_encode(true);
	}



	//ADMIN

	public function store(Request $request){

		$database = $this->initFirebase();
		$new = $database
        ->getReference('aviones')
        ->push([
        	'plaza' => $request->plaza
        ]);
		return redirect('/avion');
	}

	 public function edit($id){
    	$avion = Avion::find($id);
    	$database = $this->initFirebase();
    	$avion = $database->getReference('aviones/'.$id)->getValue();
    	return view('update_avion', ['avion'=> json_decode(json_encode( ['id'=>$id, 'plaza'=>$avion['plaza']] )) ]);
    }

	public function home(){

		$database = $this->initFirebase();

        $aviones = $database->getReference('aviones')->getValue();
        
        $parced_array  = array();
        foreach ($aviones as $key => $value){
        	array_push( $parced_array, json_decode(json_encode(  ['id'=>$key, 'plaza' => $value['plaza']] )) );
        }

		return view('avion',['aviones'=>$parced_array]);
	}

	public function delete(Request $request){
		$database = $this->initFirebase();
		$database->getReference('aviones/'. $request->id)->remove();
		return redirect('/avion');
	}

	public function update(Request $request){
		$database = $this->initFirebase();
		$database->getReference('aviones/'. $request->id)->set([
			'plaza' => $request->plaza
		]);			
		return redirect('/avion');
	}

}