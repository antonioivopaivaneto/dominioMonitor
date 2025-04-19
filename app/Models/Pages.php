<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = ['url','user_id','status','email','frequency','verification_enabled','last_verification'];

    public function getLastVerificationAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:m');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
public function verificacoes()
{
    return $this->hasMany(Verificacoes::class, 'page_id'); // Verifique se o nome da chave estrangeira está correto
}


}
