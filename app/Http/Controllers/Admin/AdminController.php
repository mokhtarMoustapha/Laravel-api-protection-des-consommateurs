<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Hash;

class AdminController extends Controller
{
    public function login(Request $request){
    //on a quune seule admin
    $admin = Admin::first();
    if ($admin && Hash::check($request->password, $admin->password)) {
            $success['token']=$admin->createToken(request()->userAgent())->plainTextToken;
            $success['success']=true;
            $success['message']="login success";
            return response()->json($success,200);
    } else {
        return response()->json(['message' => 'Mot de passe incorrect'], 401);
    }
}

//deconnexion de ladmin
    public function logout(Request $request){
        // Supprimer le token de l'utilisateur connecté
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }
}
