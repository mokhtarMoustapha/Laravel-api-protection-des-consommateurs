<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
           $table->string('commune');  
            $table->string('horaires'); 
            $table->string('casier_judiciaire')->nullable();
            $table->string('carte_identite')->nullable();
            $table->string('extrait_naissance')->nullable();
            $table->date('rendez_vous')->nullable();
            $table->string('rapport')->nullable();
            $table->string('role')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
