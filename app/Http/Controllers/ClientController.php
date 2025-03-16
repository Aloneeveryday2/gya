<?php

use App\Models\Partageur;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller

{

    public function ajouterClient(Request $request)
{
    $request->validate([
        'partageur_id' => 'required|exists:partageurs,id',
        'client_id' => 'required|exists:clients,id',
    ]);

    $partageur = Partageur::findOrFail($request->partageur_id);

    if ($partageur->aAtteintLimiteClients()) {
        return response()->json([
            'message' => 'Limite de clients atteinte pour cet abonnement.'
        ], 403);
    }

    // Ajouter le client
    Client::create([
        'partageur_id' => $request->partageur_id,
        'client_id' => $request->client_id,
        'statut' => 'actif',
    ]);

    return response()->json([
        'message' => 'Client ajouté avec succès.'
    ]);
}


}

