<?php

namespace App\Http\Controllers\CHEF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rapport;

class RapportController extends Controller
{
    public function envoyeRapport(Request $request){
      $rapport = new Rapport();
      $rapport->chef_id=auth()->user()->id;
      $rapport->plainte_id=$request->plainte_id;
      $rapport->valide=$request->valide;
      if(!$rapport->save()){ 
        return response()->json(['message' => 'Erreur, rapport non envoyé'], 500);
        } 
    else{
    return response()->json(['message' => 'Rapport envoyé avec succès'], 200);
    }
}



public function afficherRapports() {
    $rapports = Rapport::with(['user' => function ($query) {
        $query->select('id', 'name', 'tel');
    }, 'plainte' => function ($query) {
        $query->select('id', 'code', 'commune');
    }])->get(['id', 'chef_id', 'valide', 'plainte_id']);

    // Transformer le format de la réponse
    $rapports = $rapports->map(function ($rapport) {
        return [
            'id' => $rapport->id,
            'valide' => $rapport->valide,
            'nom_chef' => $rapport->user ? $rapport->user->name : '',
            'tel' => $rapport->user ? $rapport->user->tel : '',
            'code' => $rapport->plainte ? $rapport->plainte->code : '',
            'commune' => $rapport->plainte ? $rapport->plainte->commune : '',
        ];
    });

    return response()->json($rapports, 200);
}

    }

