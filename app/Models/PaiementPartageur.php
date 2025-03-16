<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementPartageur extends Model
{
    use HasFactory;

    protected $fillable = [
        'partageur_id',
        'montant',
        'type_paiement',
        'statut',
        'date_paiement',
        'expiration',
    ];

    public function partageur()
    {
        return $this->belongsTo(Partageur::class);
    }
}

