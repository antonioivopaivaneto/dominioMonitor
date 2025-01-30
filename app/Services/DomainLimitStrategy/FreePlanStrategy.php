<?php

namespace App\Services\DomainLimitStrategy;

use App\Models\User;
use App\Services\DomainLimitStrategy\DomainLimitStrategy;

class FreePlanStrategy implements DomainLimitStrategy
{
    private const MAX_DOMAINS = 2;


    public function canAddDomain(User $user): bool
    {

        return $user->dominios()->count() < self::MAX_DOMAINS;
    }
}
