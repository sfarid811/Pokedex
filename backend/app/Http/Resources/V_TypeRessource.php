<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\DB;//ajout pour call_type


class V_TypeRessource extends JsonResource
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
        $v_pokemon_type = DB::table('Types')->find($id);//récupère les types avec l'id
        if ($v_pokemon_type!==null) {
            $type_inside['type1'] = $v_pokemon_type->type1;//stock le type dans un tableau
            $type_inside['type2'] = $v_pokemon_type->type2;
            return $type_inside;
        }
        else {
            return "none";
        }   
    }
}
