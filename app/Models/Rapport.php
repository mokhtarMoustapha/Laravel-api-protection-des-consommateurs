<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;
     protected $table = 'rapports';

    protected $fillable=[
        'chef_id',
        'plainte_id',
        'valide'
    ];

     public function user(){
        return $this->belongsTo(User::class, 'chef_id');
    }

     public function plainte(){
        return $this->belongsTo(Plainte::class);
    }
}
