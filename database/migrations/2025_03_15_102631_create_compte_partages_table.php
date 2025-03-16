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
    Schema::create('comptes_partages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('type_compte'); // Netflix, Spotify, etc.
        $table->integer('prix');
        $table->text('details')->nullable();
        $table->integer('max_utilisateurs')->default(4);
        $table->enum('statut', ['disponible', 'complet'])->default('disponible');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compte_partages');
    }
};
