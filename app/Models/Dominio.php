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

    public function getExpirationAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

}
