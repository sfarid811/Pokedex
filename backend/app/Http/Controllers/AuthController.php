<?php

namespace App\Http\Controllers;

use App\Models\token_data;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $user = User::create([
      'name' => $request->name, //remplit la base de donée
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    return $this->respondWithToken($this->makeToken($request));
  }

  public function login(Request $request)
  {
    $credentials = $request->only(['email', 'password']);

    if (!$token_check = Auth::attempt($credentials)) { //token
      return response()->json(['error' => 'Unauthorized'], 401);
    }
    return $this->respondWithToken($this->updateToken($request));
  }
/* YAN**********************/
  public function checkToken(Request $request)
  {
    $userToken = $request->get('userToken');
    $userEmail = $request->get('userEmail');
    
    // Get id of this token
    $token_data = DB::table('token_datas')->where('token', '=', $userToken)->first();

    if (!$token_data) {
      return ['validation' => false];
    }
    
    if ($token_data->client_id && $token_data->client_id > 0) {
      $user = User::findOrFail($token_data->client_id);
      
      if ($user && $user->email == $userEmail) {
        return ['validation' => true];
      } else {
        return ['validation' => false];
      }
    }

    return false;
  }
/*fin Yan****************/
  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      //'expires_in' => Auth::factory()->getTTL() * 60
    ]);
  }

  protected function makeToken($request)
  { //fonction qui crée un token.
    $string_tok = $request->email . $request->password;
    $token  = bcrypt(($string_tok));
    // $token = Auth::login($user);
    //stocker dans my sql
    $mytime = Carbon::now();
    $string_date = $mytime->toDateTimeString();
    $id = DB::table('users')->where('email', $request->email)->value('id');
    DB::insert('insert into token_datas (token, client_id, updated_at) values (?, ?, ?)', [ //remplit la base de donée
      $token, // stock le token 
      $id, //l'id de la personne
      $string_date //la date
    ]);
    app('App\Http\Controllers\Random_pok')->get_random_pok($request);
    return $token;
  }

  protected function updateToken($request)
  { //fonction qui crée un token.
    $id = DB::table('users')->where('email', $request->email)->value('id');
    $string_tok = $request->email . $request->password;
    $token  = bcrypt(($string_tok));
    DB::table('token_datas')->where('client_id', $id)->update(['token' => $token]); //met à jour le token

    $mytime = Carbon::now();
    $string_date = $mytime->toDateTimeString();
    DB::table('token_datas')->where('client_id', $id)->update(['updated_at' => $string_date]); //met à jour la date
    
    app('App\Http\Controllers\Random_pok')->givepokemon($request);//check and give pokemon

    return $token;
  }
}
