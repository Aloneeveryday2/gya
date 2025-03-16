<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('acces_abonnements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('compte_id')->constrained('comptes_partages')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamp('date_ajout')->useCurrent();
        $table->enum('statut_accès', ['en attente', 'actif', 'expiré'])->default('en attente');
        $table->enum('statut_approbation', ['en attente', 'approuvé', 'refusé'])->default('en attente');
        $table->integer('nombre_rappels')->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acces_abonnements');
    }
};
