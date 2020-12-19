<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pokedex extends Model
{
    protected $table = 'Pokedex';

    public static function result($number)
    {
        $pokedex = Pokedex::paginate($number);
        //$pokedex = PokedexRessource::collection($pok); permet de change le nom pour le premier tableau.
        $v_pokemon_type = DB::table('Pokedex') //stockage de la recherche dans un tableau
            ->join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok') //croisement de donées pour avoir les types selon l'id du pokemon
            ->select('Types.type1', 'Types.type2') //les élements qu'on souahite avoir
            ->get();
            
        for ($i = 0; $i < count($pokedex); $i++) { //on parcour ensuite le tableau avec tout les pokemons
            $pokedex[$i]['type'] = $v_pokemon_type[$i]; //pour ajouter un  tableau à chaque pokemon [$i] avec la clé['type'] et la valeur du tableau des types
        };
        return $pokedex; // on fait un return de ce tabelau
    }

}
