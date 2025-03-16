<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PaiementPartageur;
use Carbon\Carbon;

class CheckPartageurAbonnement
{
    public function handle(Request $request, Closure $next)
    {
        $partageur = $request->user();

        if (!$partageur) {
            return redirect('/login');
        }

        $dernierPaiement = PaiementPartageur::where('partageur_id', $partageur->id)
                            ->orderBy('date_paiement', 'desc')
                            ->first();

        if (!$dernierPaiement || $dernierPaiement->expiration < Carbon::now()) {
            return redirect()->route('paiement.partageur')->with('error', 'Votre abonnement a expiré.');
        }

        return $next($request);
    }
}

