<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use Auth;
use Inertia\Inertia;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeService
{

    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createCheckoutSession($plan)
    {
        $user = Auth::user();

        try {
            // Cria uma sessão de checkout no Stripe
            $session = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => $user->email,
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'BRL',
                        'product_data' => [
                            'name' => $plan->name,
                        ],
                        'recurring' => [
                            'interval' => 'year', // Pode ser 'month' ou 'year', conforme o seu plano
                        ],
                        'unit_amount' => $plan->price * 100, // Stripe usa centavos
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',  // Modo de assinatura
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
            ]);


            // Verifique se o ID foi gerado corretamente
            if (isset($session->id)) {
                return $session->url;
            }

            throw new \Exception('Erro ao criar a sessão de checkout.');
        } catch (\Exception $e) {
            // Log de erro
            \Log::error('Erro ao criar a sessão de checkout: ' . $e->getMessage());
            return null;
        }
    }

    public function handlePaymentSuccess($session_id)
    {
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        $user = Auth::user();
        $premiumPlan = Plan::where('name', 'premium')->first();


        if (!$premiumPlan) {
            return response()->json(['erro' => 'Planmo nao encontrado'], 404);
        }

        // Ativar assinatura
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $premiumPlan->id,
            'status' => 'active',
            'started_at' => now(),
            'expires_at' => now()->addYear(), // 1 ano de assinatura
        ]);

        $payment = Payment::create([
            'user_id' => $user->id,
            'payment_id' => $session->id,
            'amount' => $session->amount_total / 100,
            'currency' => $session->currency,
            'subscription_id' => $subscription->id ,
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $user->subscription->update([
            'plan_id' => $premiumPlan->id,
            'status' => 'active',
        ]);

        return $payment;
    }
}
