<?php

use App\Services\DomainService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Services\WhoisService;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('verificar-dominios',function(){
    app(DomainService::class)->verificarDominioVencimento();
})->purpose('Verificar domoanios proximos do vencimento')->daily();
