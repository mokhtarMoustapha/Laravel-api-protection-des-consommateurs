<?php

namespace App\Http\Controllers\CHEF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plainte;

class ExaminationController extends Controller
{
    public function traitementEncours($id){
        $user = auth()->user();
        $plainte=Plainte::find($id);
        $plainte->examiner="en cours";
        $plainte->chef_id=$user->id;
         if(!$plainte->save()){ 
        return response()->json(['message' => 'Erreur, lors de lenvoie'], 500);
        } 
    else{
    return response()->json(['message' => ' traitement encours'], 200);
    }
    }
   //affichage plainte en cours 
    public function PlainteEncours(){
    $user = auth()->user();
    $plaintes = Plainte::with('user:id,name,tel')
         ->where('chef_id', $user->id)
        ->where('examiner', 'en cours')
        ->select('id', 'details', 'commune',"code", 'image', 'adresse', 'examiner', 'user_id','chef_id')
        ->get();
 // Formatter la réponse pour retourner uniquement les champs voulus
    $formatted = $plaintes->map(function ($plainte) {
        return [
            'details'   => $plainte->details,
            'commune'   => $plainte->commune,
            'examiner'    => $plainte->examiner, 
            'valid' =>  $plainte->valid,
            'image'     => $plainte->image,
            'adresse'   => $plainte->adresse,
            'user_name' => $plainte->user->name ?? null,
            'telephone' => $plainte->user->tel ?? null,
        ];
    });
    return response()->json($formatted);
}

 public function traitementfinal($id ,Request $request){
        $user = auth()->user();
        $plainte=Plainte::find($id);
        $plainte->examiner="examiner";
         if(!$plainte->save()){ 
        return response()->json(['message' => 'Erreur, lors de lenvoie'], 500);
        } 
    else{
    return response()->json(['message' => ' plainte examiner'], 200);
    }
    }
// public function historychef(){
//     $user = auth()->user();
// }
}
