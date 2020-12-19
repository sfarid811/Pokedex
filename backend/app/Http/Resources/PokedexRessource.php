<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PokedexRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       /* return [
            'id_pok'  => $this->id_pok,
            'nom' => $this->nom_pok,
        ];// permet de renommer le JSON*/
        return parent::toArray($request);
    }
}
