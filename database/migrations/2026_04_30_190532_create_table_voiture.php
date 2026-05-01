<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_voiture', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('modele');
            $table->integer('annee');
            $table->string('couleur');
            $table->string('path_image');
            $table->decimal('kilometrage', 15, 2);
            $table->decimal('prix_jour', 10, 2)->default(0);
            $table->string('statut')->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_voiture');
    }
};
