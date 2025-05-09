<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verificacoes extends Model
{
    protected $fillable = ['page_id','status','detalhes','verificado_em'];


    protected $casts = [
        'verificado_em' => 'datetime',
    ];

    public function page()
    {
        return $this->belongsTo(Pages::class);
    }


}
