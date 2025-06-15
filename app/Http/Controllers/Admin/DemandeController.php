<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Http\Requests\User\DemandeRequest;
use Carbon\Carbon;

class DemandeController extends Controller
{
    public function ajouterDemande(DemandeRequest $request)
    {
        $demande = new Demande();
        $demande->commune = $request->commune;
        $demande->horaires = $request->horaires;
        $demande->user_id = auth()->user()->id;
        
        $aujourdHui = Carbon::now();
       $jourDeLaSemaine = $aujourdHui->dayOfWeek; // 0 = Dimanche, 6 = Samedi
        // Ajouter les jours en fonction du jour de la semaine
        if ($jourDeLaSemaine === 0) { // Dimanche
            $demande->rendez_vous = $aujourdHui->addDays(9);
        } elseif ($jourDeLaSemaine === 6) { // Samedi
            $demande->rendez_vous = $aujourdHui->addDays(8);
        } else {
            $demande->rendez_vous = $aujourdHui->addDays(7); // Valeur par défaut
        }
        
        // Handle file uploads
        if ($request->hasFile('casier_judiciaire')) {
            $demande->casier_judiciaire = $request->file('casier_judiciaire')->store('documents', 'public');
        }
        if ($request->hasFile('carte_identite')) {
            $demande->carte_identite = $request->file('carte_identite')->store('documents', 'public');
        }
        if ($request->hasFile('extrait_naissance')) {
            $demande->extrait_naissance = $request->file('extrait_naissance')->store('documents', 'public');
        }

        $demande->save();
        return response()->json(['message' => 'Demande ajoutée avec succès !'], 200);
    }
//recuperer demande
public function afficherDemande()
{
    $demandes = Demande::get(['id', 'user_id', 'commune', 'horaires','carte_identite','casier_judiciaire','rendez_vous','extrait_naissance'  ,'created_at']);

    // Transformer le format de la réponse
    $demandes = $demandes->map(function ($demande) {
        return [
            'id' => $demande->id,
            'commune' => $demande->commune,
            'horaires' => $demande->horaires,
            'user_id' => $demande->user_id,
            'carte_identite' => $demande->carte_identite,
            'casier_judiciaire' => $demande->casier_judiciaire,
            'extrait_naissance' => $demande->extrait_naissance,
            'rendez_vous' => $demande->rendez_vous,
            'temps_creation'=>$demande->created_at
        ];
    });

    return response()->json($demandes, 200);
}


}
