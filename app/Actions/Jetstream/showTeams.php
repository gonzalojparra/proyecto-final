<?php

namespace App\Actions\Jetstream;

use App\Http\Controllers\Controller;
use App\Models\Team;

class ControllerShowTeams extends Controller{

    public function showTeams(){
        $teams = Team::all();
        // return view('auth.register', ['escuelas'=>$teams]);
        return $teams;
    }

}

?>