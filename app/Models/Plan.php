<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'max_domains', 'price'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public static function premium()
    {
        return  self::where('name','premium')->first();

    }
}
