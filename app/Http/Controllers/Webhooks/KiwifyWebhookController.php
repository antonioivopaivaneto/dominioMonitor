<?php

namespace App\Http\Controllers\Webhooks;

use App\Enums\SubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KiwifyWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();

        Log::info('Webhook Kiwify recebido', $data);

        // =========================
        // Dados essenciais
        // =========================
        $event       = data_get($data, 'webhook_event_type');
        $orderStatus = data_get($data, 'order_status');
        $orderId     = data_get($data, 'order_id');
        $email       = data_get($data, 'Customer.email');
        $productId   = data_get($data, 'Product.product_id');

        if (!$email || !$productId || !$orderId) {
            Log::warning('Webhook Kiwify incompleto', compact('email', 'productId', 'orderId'));
            return response()->json(['ignored' => true]);
        }

        // =========================
        // Usuário e Plano
        // =========================
        $user = User::where('email', $email)->first();
        $plan = Plan::where('kiwify_product_id', $productId)->first();

        if (!$user || !$plan) {
            Log::warning('Usuário ou plano não encontrado', compact('email', 'productId'));
            return response()->json(['ignored' => true]);
        }

        // =========================
        // Idempotência
        // =========================
        if (Payment::where('payment_id', $orderId)->exists()) {
            return response()->json(['duplicate' => true]);
        }

        // =========================
        // ✅ PAGAMENTO APROVADO
        // (MESMA LÓGICA DO STRIPE)
        // =========================
        if ($event === 'order_approved' && $orderStatus === 'paid') {

            // Cancela qualquer assinatura anterior
            Subscription::where('user_id', $user->id)
                ->update(['status' => SubscriptionStatus::EXPIRED]);

            // Datas vindas da Kiwify
            $start = data_get($data, 'Subscription.start_date');
            $next  = data_get($data, 'Subscription.next_payment');

            // Cria nova subscription ativa
            $subscription = Subscription::create([
                'user_id'    => $user->id,
                'plan_id'    => 2,
                'status'     => SubscriptionStatus::ACTIVE,
                'started_at' => $start ? now()->parse($start) : now(),
                'expires_at' => $next ? now()->parse($next) : null,
            ]);

            // Registra pagamento
            Payment::create([
                'user_id'         => $user->id,
                'subscription_id' => $subscription->id,
                'payment_id'      => $orderId,
                'amount'          => data_get($data, 'Commissions.my_commission') / 100,
                'currency'        => data_get($data, 'Commissions.currency', 'BRL'),
                'status'          => 'paid',
                'paid_at'         => now(),
            ]);

            Log::info('Assinatura PREMIUM ativada', [
                'user_id' => $user->id,
                'plan' => $plan->name
            ]);
        }

        // =========================
        // ❌ CANCELAMENTO REAL
        // =========================
        if (in_array($event, ['subscription_canceled'])) {
            Subscription::where('user_id', $user->id)
                ->where('status', SubscriptionStatus::ACTIVE)
                ->update(['status' => SubscriptionStatus::CANCELED]);
        }

        return response()->json(['ok' => true]);
    }
}
