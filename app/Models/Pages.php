<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = ['url','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
