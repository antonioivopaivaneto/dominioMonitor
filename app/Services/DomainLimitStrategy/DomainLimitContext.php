<?php


namespace App\Services\DomainLimitStrategy;

use App\Models\User;

class DomainLimitContext
{

    private DomainLimitStrategy $strategy;

    public function __construct(User $user)
    {
        $this->strategy = $this->resolveStrategy($user);

    }

    private function resolveStrategy(User $user):DomainLimitStrategy
    {
        $planName = $user->subscription?->plan?->name ?? 'free';

        return $planName =='premium' ? new PremiumPlanStrategy() : new FreePlanStrategy();

    }

    public function canAddDomain(User $user):bool
    {
        return $this->strategy->canAddDomain($this->$user);
    }




}
