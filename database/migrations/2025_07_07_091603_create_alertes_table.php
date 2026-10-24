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
        Schema::create('alertes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('matrice_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_alerte_id')->constrained('type_alertes')->onDelete('cascade');

            $table->string('marqueProduit');
            $table->string('nomProduit');
            $table->string('photoProduit')->nullable();
            $table->string('distributeur');
            $table->text('motif');
            $table->string('departement');
            $table->string('statut')->default('en attente');
            $table->string('numeroSuivi')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertes');
    }
};
