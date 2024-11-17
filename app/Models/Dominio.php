<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dominio extends Model
{
    protected $fillable = ['dominio','expiration','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
