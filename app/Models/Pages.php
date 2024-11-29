<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = ['url','user_id','status','email','frequency','verification_enabled','last_verification'];



    public function user(){
        return $this->belongsTo(User::class);
    }
    public function verificacoes(){
        return $this->hasMany(Verificacoes::class);
    }
    

}
