<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaiementPartageur;
use App\Models\Partageur;
use Carbon\Carbon;

class PaiementPartageurController extends Controller
{
    // Afficher la page de paiement
    public function showForm()
    {
        return view('paiement.partageur');
    }

    // Traiter le paiement du partageur
    public function process(Request $request)
    {
        $request->validate([
            'partageur_id' => 'required|exists:partageurs,id',
            'type_paiement' => 'required|string',
        ]);

        $paiement = PaiementPartageur::create([
            'partageur_id' => $request->partageur_id,
            'montant' => 1000,
            'type_paiement' => $request->type_paiement,
            'statut' => 'payé',
            'date_paiement' => Carbon::now(),
            'expiration' => Carbon::now()->addMonth(),
        ]);

        return redirect()->route('paiement.success')->with('success', 'Paiement réussi !');
    }

    // Vérifier l'abonnement du partageur
    public function checkStatus($partageur_id)
    {
        $dernierPaiement = PaiementPartageur::where('partageur_id', $partageur_id)
                            ->orderBy('date_paiement', 'desc')
                            ->first();

        if (!$dernierPaiement || $dernierPaiement->expiration < Carbon::now()) {
            return response()->json(['abonnement_actif' => false]);
        }

        return response()->json(['abonnement_actif' => true]);
    }
}



