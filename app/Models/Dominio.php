<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Dominio extends Model
{
    protected $fillable = ['dominio','notificado','expiration','dias_antecendencia','user_id','status','email'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Não precisa formatar
public function getExpirationAttribute($value)
{
    return Carbon::parse($value); // retorna um objeto Carbon
}

    public function getDataAvisoAttribute(): string
    {
        $expiration = Carbon::parse($this->getOriginal('expiration')); // 👈 pega valor original (Y-m-d)
        return $expiration->subDays($this->dias_antecendencia)->format('d/m/Y');
    }


}
