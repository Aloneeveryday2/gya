<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abonnement;
use Illuminate\Support\Facades\Auth;

class AbonnementController extends Controller
{
    public function approuver($id)
{
    $abonnement = Abonnement::findOrFail($id);
    $abonnement->is_approved = true;
    $abonnement->save();

    return response()->json(['message' => 'Client approuvé !']);
}

public function dashboard(){
    $user = Auth::user();
    $subscriptions = []; // Initialize empty subscriptions array
    return view('user.dashboard', compact('user', 'subscriptions'));
}

}
