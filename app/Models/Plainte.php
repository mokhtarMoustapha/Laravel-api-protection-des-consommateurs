<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Plainte extends Model
{
    use HasFactory;
    protected $table = 'plaintes';

    protected $fillable=[
        'user_id',
        'chef_id',
        'details',
        'adresse',
        'commune',
        'image',
        'etat',
        'rapport'
        
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function chef(){
        return $this->belongsTo(User::class, 'chef_id');
    }
}