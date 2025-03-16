<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partageur;
use App\Models\Abonnement;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;


class PartageurController extends Controller
{
        public function afficherClients($partageur_id)
    {
        $partageur = Partageur::with('clientsActifs')->findOrFail($partageur_id);

        return response()->json($partageur->clientsActifs);
    }


    public function dashboard()
    {
        $user = Auth::user();
        $abonnements = Abonnement::where('partageur_id', $user->id)->get();
        $nombreAbonnes = $abonnements->sum('nombre_abonnes');
        $revenuTotal = $abonnements->sum('revenu_total');
        $subscriptionActive = $user->subscription_active ?? false;

        return view('partageurs.dashboard', compact('abonnements', 'nombreAbonnes', 'revenuTotal', 'subscriptionActive'));
    }

    public function ajouterAbonnement()
    {
        // Vérifier si l'abonnement est actif
        $user = Auth::user();
        if (!$user->subscription_active) {
            return redirect()->route('partageurs.dashboard')
                ->with('error', 'Vous devez avoir un abonnement actif pour ajouter des services.');
        }

        return view('partageurs.abonnements.create');
    }

    public function mesAbonnements()
    {
        $abonnements = Abonnement::where('partageur_id', Auth::id())->get();
        return view('partageurs.abonnements.index', compact('abonnements'));
    }

    public function create()
    {
        return view('partageurs.abonnements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_service' => 'required|string',
            'prix' => 'required|numeric',
            'description' => 'required|string',
            'places_disponibles' => 'required|integer|min:1',
            'duree' => 'required|integer|min:1',
        ]);

        $abonnement = new Abonnement($validated);
        $abonnement->partageur_id = Auth::id();
        $abonnement->statut = 'disponible';
        $abonnement->save();

        return redirect()->route('partageurs.abonnements')
            ->with('success', 'Abonnement ajouté avec succès');
    }

    public function modifierAbonnement(Abonnement $abonnement)
    {
        if ($abonnement->partageur_id !== Auth::id()) {
            abort(403);
        }
        return view('partageurs.abonnements.edit', compact('abonnement'));
    }

    public function mettreAJourAbonnement(Request $request, Abonnement $abonnement)
    {
        if ($abonnement->partageur_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'prix' => 'required|numeric',
            'description' => 'required|string',
            'places_disponibles' => 'required|integer|min:1',
            'duree' => 'required|integer|min:1',
        ]);

        $abonnement->update($validated);

        return redirect()->route('partageurs.abonnements')
            ->with('success', 'Abonnement mis à jour avec succès');
    }

    public function supprimerAbonnement(Abonnement $abonnement)
    {
        if ($abonnement->partageur_id !== Auth::id()) {
            abort(403);
        }

        $abonnement->delete();

        return redirect()->route('partageurs.abonnements')
            ->with('success', 'Abonnement supprimé avec succès');
    }

    public function abonnes()
    {
        $abonnements = Abonnement::where('partageur_id', Auth::id())
            ->with('abonnes')
            ->get();
        return view('partageurs.abonnes', compact('abonnements'));
    }

    public function transactions()
    {
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();
        return view('partageurs.transactions', compact('transactions'));
    }

    public function logout(){
        \Illuminate\Support\Facades\Auth::logout();
        return redirect('/Accueil');
    }
}




