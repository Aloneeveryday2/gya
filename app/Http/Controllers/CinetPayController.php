<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CinetPayController extends Controller
{
    public function initiatePayment(Request $request)
    {
        try {
            $user = Auth::user();
            $reference = 'GYA-' . $user->id . '-' . time();
            $baseUrl = config('app.url');

            $response = Http::post('https://api-checkout.cinetpay.com/v2/payment', [
                'apikey' => config('services.cinetpay.api_key'),
                'site_id' => config('services.cinetpay.site_id'),
                'transaction_id' => $reference,
                'amount' => $request->input('amount', 1000),
                'currency' => 'XOF',
                'description' => $request->input('type', 'Abonnement'),
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'notify_url' => $baseUrl . '/cinetpay/notify',
                'return_url' => $baseUrl . '/cinetpay/return',
                'cancel_url' => $baseUrl . '/cinetpay/cancel',
                'channels' => 'ALL',
                'lang' => 'fr',
                'metadata' => json_encode([
                    'user_id' => $user->id,
                    'service_id' => $request->input('service_id'),
                    'type' => $request->input('type', 'subscription')
                ])
            ]);

            if ($response->successful() && isset($response['data']['payment_url'])) {
                Payment::create([
                    'user_id' => $user->id,
                    'amount' => $request->input('amount', 1000),
                    'reference' => $reference,
                    'status' => 'pending',
                    'type' => $request->input('type', 'subscription')
                ]);

                return redirect()->away($response['data']['payment_url']);
            }

            Log::error('CinetPay API error', ['response' => $response->json()]);
            return back()->with('error', 'Erreur lors de l\'initialisation du paiement');
        } catch (\Exception $e) {
            Log::error('CinetPay exception', ['error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue');
        }
    }

    public function handleNotification(Request $request)
    {
        Log::info('CinetPay Notification:', $request->all());

        try {
            $payment = Payment::where('reference', $request->transaction_id)->first();

            if (!$payment) {
                Log::error("Payment not found:", ['transaction_id' => $request->transaction_id]);
                return response()->json(['message' => 'Payment not found'], 404);
            }

            if ($request->status == 'ACCEPTED') {
                $payment->update(['status' => 'completed']);

                $user = User::find($payment->user_id);
                if ($user) {
                    $user->update([
                        'subscription_active' => true,
                        'subscription_ends_at' => now()->addMonth(),
                        'last_payment_date' => now()
                    ]);
                }
            } else {
                $payment->update(['status' => 'failed']);
            }

            return response()->json(['message' => 'Notification processed']);
        } catch (\Exception $e) {
            Log::error('CinetPay notification error', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }

    public function handleReturn()
    {
        return redirect()->route('partageurs.dashboard')
            ->with('success', 'Paiement effectué avec succès ! Votre abonnement est maintenant actif.');
    }

    public function handleCancel()
    {
        return redirect()->route('partageurs.dashboard')
            ->with('error', 'Le paiement a été annulé.');
    }
}