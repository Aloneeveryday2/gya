<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Partageur;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
    /**
     * Afficher le tableau de bord admin
     */
    public function index()
    {
        // Récupérer les statistiques
        $totalUsers = \App\Models\User::count();
        $activePartageurs = \App\Models\User::where('role', 'partageur')
            ->where('subscription_active', true)
            ->count();
        $totalRevenue = \App\Models\Transaction::where('statut', 'réussi')->sum('montant');


        // Récupérer les dernières transactions
        $recentTransactions = \App\Models\Transaction::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activePartageurs',
            'totalRevenue',
            'recentTransactions'
        ));
    }

    public function utilisateurs()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.utilisateurs', compact('users'));
    }

    /**
     * Liste des partageurs en attente d'approbation
     */
    public function listePartageurs()
    {
        $partageurs = Partageur::where('is_approved', false)->with('user')->get();
        return view('admin.partageurs', compact('partageurs'));
    }

    /**
     * Approuver un partageur
     */
    public function approuverPartageur($id)
    {
        $partageur = Partageur::findOrFail($id);
        $partageur->is_approved = true;
        $partageur->expires_at = now()->addMonth(); // 1 mois d'abonnement
        $partageur->save();

        return redirect()->back()->with('success', 'Partageur approuvé avec succès.');
    }

    /**
     * Liste des transactions
     */
    public function transactions()
    {
        $transactions = Transaction::latest()->get();
        return view('admin.transactions', compact('transactions'));
    }

    /**
     * Supprimer un utilisateur
     */
    public function supprimerUtilisateur($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Utilisateur supprimé.');
    }

    /**
     * Déconnexion de l'administrateur
     */

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
}

}

