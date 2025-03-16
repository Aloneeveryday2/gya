<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partageur extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'is_approved', 'expires_at'];

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les abonnements qu'il partage
     */
    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }

    public function clientsActifs()
{
    return $this->hasMany(Client::class)->where('statut', 'actif');
}

public function aAtteintLimiteClients()
{
    return $this->clientsActifs()->count() >= $this->max_clients;
}

}

