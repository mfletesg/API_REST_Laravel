<?php

use Illuminate\Http\Request;
use App\User;

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

header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token, x_csrftoken');

//Funcion para obtener los empleados
Route::get('/user', function(){
  $items = User::all()->toJson();
  return response($items)->header('Content-Type', 'application/json');
});


//Función para crear un nuevo usuario
Route::post('/user/create', function(Request $req){
  $data = $req->json()->all();
  $user = new User();
  $user->name = $data['name'];
  $user->email = $data['email'];
  $user->password = $data['password'];
  $user->save();
  return response(json_encode([
    'name' => $data['name'],
    'email' => $data['email'],
  ]))->header('Content-Type', 'application/json');
});


//Función para buscar un usario en especifico
Route::post('/user/search', function(Request $id){
  $id_user = $id->json()->all();
  $user = User::find($id_user);
  return response(json_encode([
    'datos' => $user
  ]))->header('Content-Type', 'application/json');
});


//Funcion para actualizar el usuario
Route::post('/user/update', function(Request $values){
  $data = $values->json()->all();
  $id_user = $data['id'];
  $user = new User();
  $user = User::find($id_user);
  $user->name = $data['name'];
  $user->email = $data['email'];
  $user->save();
  return response(json_encode([
    'estado' => 'Se actualizo el usuario'
  ]))->header('Content-Type', 'application/json');
});



//Función para eliminar un usuario en especifico
Route::post('/user/delete', function(Request $id){
  $id_user = $id->json()->all();
  $user = new User();
  $user = User::where('id',$id_user)->delete();
  return response(json_encode([
    'Correcto' => 'Se elimino el usuario'
  ]))->header('Content-Type', 'application/json');
});
