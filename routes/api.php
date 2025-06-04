<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Entry\RegisterUserController;
use App\Http\Controllers\Entry\LoginUserController;
use App\Http\Controllers\Entry\ForgetPasswordController;
use App\Http\Controllers\Plainte\PlainteController;
use App\Http\Controllers\Admin\SignalController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DemandeController;
use App\Http\Controllers\CHEF\RapportController;
use App\Http\Controllers\CHEF\ExaminationController;

//register user(creation compte)
Route::prefix('register/')->name('register.')->group(function (){
    Route::post('11',[RegisterUserController::class,'register1']);
    Route::post('12',[RegisterUserController::class,'register2']);
    Route::post('13',[RegisterUserController::class,'registerComplete']);
 });

//login user et chef
Route::post('loginUser',[LoginUserController::class,'login']);
//forgetPassword
Route::prefix('forgetPassword/')->name('forgetpassword.')->group(function (){
    Route::post('envoyeCode',[ForgetPasswordController::class,'forgetPassword']);
    Route::post('verifiCode',[ForgetPasswordController::class,'verifiecode']);
    Route::post('nouveauPassword',[ForgetPasswordController::class,'nouveauPassword']);
 });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

//utiliser par chef
Route::middleware(['auth:sanctum', 'chef'])->group(function () {
    Route::post('recuperePlainte', [PlainteController::class, 'recuperePlainte']);
    Route::post('logout',[RegisterUserController::class,'logout']);
    Route::post('envoyeRapport',[RapportController::class,'envoyeRapport']);
    Route::post('traitementEncours/{id}',[ExaminationController::class,'traitementEncours']);
    Route::post('plainteEncours',[ExaminationController::class,'plainteEncours']);
    Route::post('traitementfinal/{id}',[ExaminationController::class,'traitementfinal']);
});
//utiliser par citoyen
Route::middleware(['auth:sanctum', 'citoyen'])->group(function () {
    Route::post('envoyePlainte', [PlainteController::class, 'envoyePlainte']);
     Route::get('myhistory',[PlainteController::class,'afficherHistory']);
    Route::post('logout',[RegisterUserController::class,'logout']);
    Route::post('donneeUser',[RegisterUserController::class,'utilisateurConnecter']);
    Route::post('envoyeDemande',[DemandeController::class,'ajouterDemande']);   
});


//utiliser par ladmin////////////////////////////////////////////////////////////////////////////
//Login pour Admin
Route::post('loginAdmin',[AdminController::class,'login']);
//afficher utilisateur et tous les utilisateurs 
Route::middleware('auth:sanctum')->group(function () {
Route::prefix('afficher/')->name('afficher.')->group(function (){
  Route::get('utilisateur',[RegisterUserController::class,'afficherUsers']);
  Route::get('utilisateur/{id}',[RegisterUserController::class,'afficherUser']);
  Route::get('plainte',[PlainteController::class,'afficherPlainte']);
  Route::get('detailPlainte/{id}',[PlainteController::class,'detailPlainte']);
  route::get('demande',[DemandeController::class,'afficherDemande']);
  route::get('rapport',[RapportController::class,'afficherRapports']);
});
//modifier colonne signal
Route::put('signal/{id}', [SignalController::class, 'updateSignal']);
//transforme citoyen vers chef
Route::post('transformer/{id}',[SignalController::class, 'AjouterChef']);
});
// //supprimer user
// Route::delete('supprimer/{id}',[RegisterUserController::class,'supprimerUser']);



