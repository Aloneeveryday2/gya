<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'partageur_id',
        'user_id', // L'utilisateur qui s'abonne
        'statut',  // actif, suspendu, supprimé
        'date_abonnement',
        'date_expiration',
    ];

    protected $dates = ['date_abonnement', 'date_expiration'];

    // Relation avec le partageur
    public function partageur()
    {
        return $this->belongsTo(Partageur::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Vérifier si l'abonnement est encore valide
    public function estValide()
    {
        return now()->lt($this->date_expiration);
    }
}

