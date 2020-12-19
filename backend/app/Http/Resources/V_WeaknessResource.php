<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class V_WeaknessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
    public static function call_resource($id){
        $v_pokemon_weakness = DB::table('Weaknesses')->find($id);//récupère les weaknesss avec l'id
        $weakness_inside['bug'] = $v_pokemon_weakness->bug;
        $weakness_inside['dragon'] = $v_pokemon_weakness->dragon;
        $weakness_inside['electric'] = $v_pokemon_weakness->electric;
        $weakness_inside['fairy'] = $v_pokemon_weakness->fairy;
        $weakness_inside['fight'] = $v_pokemon_weakness->fight;
        $weakness_inside['fire'] = $v_pokemon_weakness->fire;
        $weakness_inside['flying'] = $v_pokemon_weakness->flying;
        $weakness_inside['ghost'] = $v_pokemon_weakness->ghost;
        $weakness_inside['grass'] = $v_pokemon_weakness->grass;
        $weakness_inside['ground'] = $v_pokemon_weakness->ground;
        $weakness_inside['ice'] = $v_pokemon_weakness->ice;
        $weakness_inside['normal'] = $v_pokemon_weakness->normal;
        $weakness_inside['poison'] = $v_pokemon_weakness->poison;
        $weakness_inside['psychic'] = $v_pokemon_weakness->psychic;
        $weakness_inside['rock'] = $v_pokemon_weakness->rock;
        $weakness_inside['steel'] = $v_pokemon_weakness->steel;
        $weakness_inside['water'] = $v_pokemon_weakness->water;

        return $weakness_inside;
    }
}
