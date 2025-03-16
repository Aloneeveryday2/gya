<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    AdminController,
    PaiementController,
    AbonnementController,
    HomeController,
    BoutiqueController,
    CinetPayController,
    PaiementPartageurController,
    PartageurController
};

// Accueil
Route::get('/Accueil', [HomeController::class, 'index'])->name('home');

// Dashboard utilisateur (corrigé)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dash'])->name('dashboard');

    // CinetPay routes
    Route::post('/cinetpay/initiate', [CinetPayController::class, 'initiatePayment'])->name('cinetpay.initiate');
    Route::get('/cinetpay/return', [CinetPayController::class, 'handleReturn'])->name('cinetpay.return');
    Route::get('/cinetpay/cancel', [CinetPayController::class, 'handleCancel'])->name('cinetpay.cancel');
});

// Notification route (no auth required)
Route::post('/cinetpay/notify', [CinetPayController::class, 'handleNotification'])->name('cinetpay.notify');

// Gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs');
    Route::get('/partageurs', [AdminController::class, 'listePartageurs'])->name('partageurs');
    Route::post('/partageur/{id}/approuver', [AdminController::class, 'approuverPartageur'])->name('approuverPartageur');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions');
    Route::delete('/utilisateur/{id}', [AdminController::class, 'supprimerUtilisateur'])->name('supprimerUtilisateur');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Gestion des services
    Route::resource('/services', AdminController::class)->except(['show']);

    // Vues spécifiques
    Route::view('/paiements', 'admin.paiements')->name('paiements');
    Route::view('/abonnements', 'admin.abonnements')->name('abonnements');
});

// Routes PARTAGEURS
Route::middleware(['auth', 'role:partageur'])->prefix('partageurs')->name('partageurs.')->group(function () {
    Route::get('/dashboard', [PartageurController::class, 'dashboard'])->name('dashboard');
    Route::get('/abonnements', [PartageurController::class, 'mesAbonnements'])->name('abonnements');
    Route::get('/abonnements/create', [PartageurController::class, 'ajouterAbonnement'])->name('abonnements.create');
    Route::post('/abonnements', [PartageurController::class, 'enregistrerAbonnement'])->name('abonnements.store');
    Route::get('/abonnes', [PartageurController::class, 'abonnes'])->name('abonnes');
    Route::get('/transactions', [PartageurController::class, 'transactions'])->name('transactions');
});

// Paiements utilisateurs
Route::post('/payer', [PaiementController::class, 'payer'])->name('payer');
Route::get('/paiement/{id}', [PaiementController::class, 'showForm'])->name('paiement.form');
Route::post('/paiement/process', [PaiementController::class, 'process'])->name('paiement.process');
Route::get('/paiement/success', [PaiementController::class, 'success'])->name('paiement.success');

// Paiements partageurs
Route::middleware(['auth'])->group(function () {
    Route::get('/paiement/partageur', [PaiementPartageurController::class, 'showForm'])->name('paiement.partageur');
    Route::post('/paiement/partageur/process', [PaiementPartageurController::class, 'process'])->name('paiement.partageur.process');
});

Route::get('/status/{id}', [PaiementPartageurController::class, 'checkStatus'])->name('status');

// Gestion des abonnements
Route::prefix('abonnements')->name('abonnements.')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::post('/approbation/{abonnement_id}', [AbonnementController::class, 'approuver'])->name('approuver');
    Route::delete('/{id}/retirer', [AbonnementController::class, 'retirerAbonne'])->name('retirer');
});

// Boutique
Route::prefix('boutique')->name('boutique.')->group(function () {
    Route::get('/', [BoutiqueController::class, 'index'])->name('index');
    Route::get('/{id}', [BoutiqueController::class, 'show'])->name('show');
});

// Auth routes
require __DIR__.'/auth.php';

Route::post('/payment/notify', [PaiementController::class, 'notify'])->name('payment.notify');


Route::post('/cinetpay/callback', [PaiementController::class, 'handleCallback']);