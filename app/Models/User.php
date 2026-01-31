<?php

namespace App\Models;

use App\Enums\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'whatsapp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* =========================
     | RELAÇÕES
     ========================= */

    public function dominios(): HasMany
    {
        return $this->hasMany(Dominio::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Pages::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription(): ?Subscription
    {
        return $this->subscriptions()
            ->where('status', SubscriptionStatus::ACTIVE)
            ->latest('started_at')
            ->first();
    }

    /* =========================
     | HELPERS DE DOMÍNIO
     ========================= */

    public function hasActiveSubscription(): bool
    {
        return (bool) $this->activeSubscription();
    }

    public function currentPlan()
    {
        return $this->activeSubscription()?->plan;
    }

    public function isPremium(): bool
    {
        return $this->currentPlan()?->name === 'premium';
    }

    /* =========================
     | BOOT
     ========================= */

    protected static function booted()
    {
        static::created(function ($user) {
            $freePlan = Plan::where('name', 'free')->first();

            if ($freePlan) {
                Subscription::create([
                    'user_id' => $user->id,
                    'plan_id' => $freePlan->id,
                    'status'  => SubscriptionStatus::ACTIVE,
                    'started_at' => now(),
                ]);
            }
        });
    }
}
