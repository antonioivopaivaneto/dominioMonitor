<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Services\StripeService;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $plan = Plan::where('name', $request->plan)->first();

        if (!$plan->kiwify_checkout_id) {
            abort(404, 'Plano não configurado');
        }

        $url = "https://pay.kiwify.com.br/{$plan->kiwify_checkout_id}";

        return redirect()->away($url);
    }
}
