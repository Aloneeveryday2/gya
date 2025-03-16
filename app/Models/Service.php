<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'badge_text',
        'badge_color',
        'button_color',
    ];

    // Relationship with subscriptions
    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }

    // Relationship with users through subscriptions
    public function users()
    {
        return $this->belongsToMany(User::class, 'abonnements');
    }
}
