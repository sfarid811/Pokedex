<?php

namespace App\Http\Controllers;

use App\Http\Resources\team as ResourcesTeam;
use App\Http\Resources\V_pokemon_id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class team extends Controller
{
    public function getTeam($id){
        $team = DB::table('users')->where('id', $id)->value('team'); //stockage de la recherche dans un tableau
        $team_array = explode(",", $team);
        $result_team =[];
        for($i=0; $i<count($team_array);$i++){
            $result_team[$i] = V_pokemon_id::result_id($team_array[$i]);
        }
        return $result_team;
    }
}
