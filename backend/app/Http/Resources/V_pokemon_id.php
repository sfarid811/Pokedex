<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class V_pokemon_id extends JsonResource
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

    public static function result_id($id)
        {
            $pokedex = DB::table('Pokedex')->where('id_pok', $id)->value('nom_pok');//récupère le nom du pokemon avec l'id
            $pokedex_img = DB::table('Pokedex')->where('id_pok', $id)->value('img');
            $type['type'] = V_TypeRessource::call_resource($id);// appel la fonction static "call type" de la classe vtyperessource
            $stat_inside['stats'] = V_StatsRessources::call_resource($id);//retourne les stats
            $weakness_inside['weaknesses'] = V_WeaknessResource::call_resource($id);//retourne les faiblesses
            $evolutions_inside['evolutions'] = V_evolutionsResource::call_resource($id);//retourne les faiblesses
            $result = [$id, $pokedex,$pokedex_img,$type, $stat_inside, $weakness_inside, $evolutions_inside];//envoie le résultat : nom et types

            return $result;// on fait un return de ce tabelau
        }
}
