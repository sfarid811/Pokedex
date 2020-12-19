<?php

namespace App\Http\Controllers;

use App\Http\Resources\V_pokemon_id;
use App\Models\Pokedex;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class random_pok extends Controller
{
    public static function get_random_pok($request) //private to protect
    {
        $team = DB::table('users')->where('email', $request->email)->value('team');
        $rand = rand(1, 151); //nombre de pokemon
        if ($team === null) { //if fisrt pokemon
            DB::table('users')->where('email', $request->email)->update(['team' => $rand]);
        } else {
            $team_array = explode(",", $team); //convertit la chaine de charater en tableau.
            if (count($team_array) < 6) { //if team is full
                $newteam = $team . ',' . $rand;
                DB::table('users')->where('email', $request->email)->update(['team' => $newteam]);
            } else {
                return "your team is full";
            }
        }
    }
    public static function givepokemon($request)
    { //fonction qui vérifie la date pour donner un pokemon
        $id = DB::table('users')->where('email', $request->email)->value('id');
        $update_at = DB::table('users')->where('id', $id)->value('last_pok'); //récupère la date à laquelle un pokemon a été donné
        $mytime = Carbon::now();
        $add24hours = strtotime($update_at) + 86400;
        if ($add24hours > strtotime($mytime)) { //vérifie si la date actuelle est supérieur à la date de l'update+24H (86400sec)
            random_pok::get_random_pok($request); //donne un pokemon
            DB::table('users')->where('id', $id)->update(['last_pok' => $mytime]); //et actualise la date
        } else {
            return "too soon to get a new pokemon";
        }
    }
}
