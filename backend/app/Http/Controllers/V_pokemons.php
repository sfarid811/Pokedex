<?php

namespace App\Http\Controllers;

use App\Http\Resources\PokedexRessource;
use App\Http\Resources\V_evolutionsResource;
use App\Http\Resources\V_pokemon_id;
use App\Http\Resources\V_pokemonsResource;
use App\Http\Resources\V_StatsRessources;
use App\Http\Resources\V_TypeRessource;
use App\Http\Resources\V_WeaknessResource;
use App\Models\Pokedex;
use App\Models\V_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class V_pokemons extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pokedex::result(15);//model Pokede
        //le paramètre de la fonction = pagination
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_pok)
    {
        return V_pokemon_id::result_id($id_pok);//et on envoie ce tableau en résultat de la ressource V_pokemon_id
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
