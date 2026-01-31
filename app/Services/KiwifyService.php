<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\User;

class KiwifyService
{
    public function getCheckoutUrl(Plan $plan, User $user): string
    {
        if (!$plan->kiwify_product_id) {
            throw new \Exception('Plano não configurado na Kiwify');
        }

        return "https://pay.kiwify.com.br/{$plan->kiwify_product_id}";
    }
}

