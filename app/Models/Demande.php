<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    protected $table = 'demandes';

    protected $fillable=[
        'user_id',
        'commune',
        'horaires',
        'carte_identite',
        'casier_judiciaire',
        'extrait_naissance',
        'rendez_vous'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
