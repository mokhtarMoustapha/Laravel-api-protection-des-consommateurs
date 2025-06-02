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
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('chef_id');
            $table->foreign('chef_id')->references('id')->on('users')->onDelete('cascade');
             $table->unsignedBigInteger('plainte_id');
            $table->foreign('plainte_id')->references('id')->on('plaintes')->onDelete('cascade');
            $table->string('valide');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
