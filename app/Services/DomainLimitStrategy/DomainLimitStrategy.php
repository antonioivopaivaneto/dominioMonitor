<?php

namespace App\Services\DomainLimitStrategy;

use App\Models\User;

interface DomainLimitStrategy
{
    public function canAddDomain(User $user):bool;
}
