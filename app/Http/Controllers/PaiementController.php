<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    public function showForm()
    {
$user = Auth::user();
        return view('paiement.form', [
            'user' => $user,
            'montant' => 1000, // Montant fixe pour l'abonnement partageur
            'type' => 'partageur_abonnement'
        ]);
    }

    /**
     * Traitement du paiement
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'montant' => 'required|numeric',
            'type' => 'required|string',
            'payment_method' => 'required|string',
            'phone' => 'required|string'
        ]);

        // Simulate payment processing (replace with actual payment gateway integration)
        $paymentSuccess = true;

        if ($paymentSuccess) {
            // Create transaction record
            $transaction = Transaction::create([
                'user_id' => $validated['user_id'],
                'montant' => $validated['montant'],
                'status' => 'success',
                'type' => $validated['type'],
                'payment_method' => $validated['payment_method'],
                'phone' => $validated['phone'],
                'expires_at' => Carbon::now()->addMonth()
            ]);

            // Update user's subscription status
            $user = User::find($validated['user_id']);
            $user->subscription_active = true;
            $user->subscription_ends_at = Carbon::now()->addMonth();
            $user->save();

            return redirect()->route('partageurs.dashboard')
                           ->with('success', 'Paiement effectué avec succès');
        }

        return back()->with('error', 'Le paiement a échoué. Veuillez réessayer.');
    }

    public function handleCallback(Request $request)
    {
        // Vérifier la signature CinetPay
        // Traiter le paiement
        // Créer l'abonnement

        return response()->json(['status' => 'success']);
    }
}

