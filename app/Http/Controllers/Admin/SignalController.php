<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class SignalController extends Controller
{
    public function updateSignal(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        $user->signal = $request->signal ?? 0;
        $user->save();
        if ($user->signal >= 3) {
           $user->blocquee= 'blocquee';
           $user->signal=0;
           $user->save();
          return response()->json(['message' => 'citoyen blocquee'], 200);
        }
        return response()->json(['message' => 'Signal mis à jour', 'user' => $user], 200);
}
//transforme user vers chef 
public function AjouterChef(Request $request, $id){ 
    $user = User::find($id); 
    if (!$user) { return response()->json(['message' => 'User non trouvé'], 404); 
    }else{ $user->role=$request->role; $user->commune=$request->commune; $user->save(); 
        return response()->json(['message' => 'citoyen transformer vers chef', 'user' => $user], 200); } }

}