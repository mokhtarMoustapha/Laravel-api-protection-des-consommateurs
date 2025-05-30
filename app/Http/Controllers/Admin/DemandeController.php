<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Http\Requests\User\DemandeRequest;

class DemandeController extends Controller
{
    public function ajouterDemande(DemandeRequest $request){
        $demande= new Demande();
        $demande->commune=$request->commune;
        $demande->horaires=$request->horaires;
        $demande->user_id=auth()->user()->id;
        $demande->save();
        return response()->json(['message' => 'Demande ajoutée avec succès !'], 200);
    }
//recuperer demande
public function afficherDemande()
{
    $demandes = Demande::with('user:id,name,tel')->get(['id', 'user_id', 'commune', 'horaires']);

    // Transformer le format de la réponse
    $demandes = $demandes->map(function ($demande) {
        return [
            'id' => $demande->id,
            'commune' => $demande->commune,
            'horaires' => $demande->horaires,
            'nom' => $demande->user ? $demande->user->name : '',
            'tel' => $demande->user ? $demande->user->tel : '',
        ];
    });

    return response()->json($demandes, 200);
}


}
