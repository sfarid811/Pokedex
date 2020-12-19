<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class V_evolutionsResource extends JsonResource
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
        $v_pokemon_evolution = DB::table('Evolutions')->find($id);//récupère les evolutions avec l'id
        if ($v_pokemon_evolution!==null){
            $evolution_inside['id_pok_base'] = $v_pokemon_evolution->id_pok_base;
            $evolution_inside['id_pok_evol'] = $v_pokemon_evolution->id_pok_evol;
            $evolution_inside['lvl_evol_pok'] = $v_pokemon_evolution->lvl_evol_pok;
            return $evolution_inside;
        }
        else {
            return "none";
        }     
    }
}
