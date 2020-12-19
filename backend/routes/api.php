<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PokemonSearch;
use App\Http\Controllers\team;
use App\Http\Controllers\UserController;
use App\Http\Controllers\V_pokemons;
use App\Http\Middleware\CheckApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('pokemons', V_pokemons::class);

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::apiResource('users', UserController::class);

Route::get("/users/{id}/team",  [team::class, "getTeam"]);// change the function

Route::get("pokemon/search", [PokemonSearch::class, "index"]);


/*
SEEDER, factory et migration => sert pour créer une donnée dans mysql
Le model sert à dire à LARAVEL le nom de la table
Le controller sert à faire une action et on utilise le model pour faire cette action sur mysql.
La ressource je ne suis pas sur : pour moi ça sert à formater la réponse en json
les routes servent à créer les routes pour l'api taper php artisan route:list pour voir la liste des routes avec les fonctions appelées
Route::apiResource('pokemons', PokedexController::class); ici => pokemons correspond à http://127.0.0.1:8000/api/pokemons pour faire notre requête depuis vue js
 Domain | Method    | URI                    | Name             | Action                                         | Middleware |
+--------+-----------+------------------------+------------------+------------------------------------------------+------------+
|        | GET|HEAD  | /                      |                  | Closure                                        | web        |
|        | GET|HEAD  | api/pokemons           | pokemons.index   | App\Http\Controllers\PokedexController@index   | api        |
|        | POST      | api/pokemons           | pokemons.store   | App\Http\Controllers\PokedexController@store   | api        |
|        | GET|HEAD  | api/pokemons/{pokemon} | pokemons.show    | App\Http\Controllers\PokedexController@show    | api        |
|        | PUT|PATCH | api/pokemons/{pokemon} | pokemons.update  | App\Http\Controllers\PokedexController@update  | api        |
|        | DELETE    | api/pokemons/{pokemon} | pokemons.destroy | App\Http\Controllers\PokedexController@destroy | api        |
=la classe pokedexcontroller est appelé sur cette route avec la foncion index.
*/
