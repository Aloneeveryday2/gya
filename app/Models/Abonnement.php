<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'partageur_id',
        'client_id',
        'service',
        'prix',
        'paiement_id',
        'is_active',
        'rappels_envoyes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relation avec l'utilisateur (le partageur)
    public function partageur()
    {
        return $this->belongsTo(User::class, 'partageur_id');
    }

    // Relation avec l'utilisateur (le client)
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Relation avec le paiement
    public function paiement()
    {
        return $this->belongsTo(Transaction::class, 'paiement_id');
    }
}
