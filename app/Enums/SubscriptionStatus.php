<?php
namespace App\Enums;

class SubscriptionStatus
{
    public const ACTIVE = 'active';
    public const PENDING = 'pending';
    public const EXPIRED = 'expired';
    public const CANCELED = 'canceled';
    public const PAST_DUE = 'past_due';
}

