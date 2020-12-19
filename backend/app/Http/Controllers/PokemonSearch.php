<?php

namespace App\Http\Controllers;

use App\Http\Resources\V_pokemon_id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PokemonSearch extends Controller
{
    public function index(Request $request)
    {
        $result_id = DB::table('Pokedex')->where("nom_pok", 'like', '%'.$request->pok.'%')->pluck("id_pok");
        $results = [];
        for($i=0;$i<count($result_id);$i++){
            $results[$i] = V_pokemon_id::result_id($result_id[$i]);
        }
        return response()->json($results);
    }
}
