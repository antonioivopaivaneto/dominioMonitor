<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Services\StripeService;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $plan= Plan::premium();


        return redirect()->to($this->stripeService->createCheckoutSession($plan));

    }

    public function success(Request $request)
    {
        $this->stripeService->handlePaymentSuccess($request->session_id);
        return redirect()->route('dashboard')->with('success','Pagamento realizado com sucesso');
    }

    public function cancel(){
        return redirect()->route('dashboard')->withErrors('Pagamento Cancelado.');
    }
}
