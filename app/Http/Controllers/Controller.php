<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



	public function initFirebase() {
       $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/aviones-91a17-firebase-adminsdk-8jltm-80897c85de.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://aviones-91a17.firebaseio.com')
        ->create();
        $database = $firebase->getDatabase();

        return $database;
   }

}
