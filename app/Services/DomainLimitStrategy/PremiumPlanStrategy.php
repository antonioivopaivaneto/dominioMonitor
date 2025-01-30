<?php

namespace App\Services\DomainLimitStrategy;

use App\Models\User;
use App\Services\DomainLimitStrategy\DomainLimitStrategy;

class PremiumPlanStrategy implements DomainLimitStrategy
{
    private const MAX_DOMAINS = 999;


    public function canAddDomain(User $user): bool
    {
        return $user->dominios()->count() < self::MAX_DOMAINS;    }
}
