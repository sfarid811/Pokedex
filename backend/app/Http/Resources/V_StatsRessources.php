<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class V_StatsRessources extends JsonResource
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
        $v_pokemon_stat = DB::table('Stats')->find($id);//récupère les stats avec l'id
        $stat_inside['hp'] = $v_pokemon_stat->hp;
        $stat_inside['attack'] = $v_pokemon_stat->attack;
        $stat_inside['defense'] = $v_pokemon_stat->defense;
        $stat_inside['sp_attack'] = $v_pokemon_stat->sp_attack;
        $stat_inside['sp_defense'] = $v_pokemon_stat->sp_defense;
        $stat_inside['speed'] = $v_pokemon_stat->speed;
        
        return $stat_inside;
    }
}
