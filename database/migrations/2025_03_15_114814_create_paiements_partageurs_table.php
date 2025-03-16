<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paiements_partageurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partageur_id')->constrained('partageurs')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->string('type_paiement'); // Mobile Money, Carte bancaire
            $table->string('statut')->default('en attente'); // en attente, payé, échoué
            $table->dateTime('date_paiement')->nullable();
            $table->dateTime('expiration')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements_partageurs');
    }
};

