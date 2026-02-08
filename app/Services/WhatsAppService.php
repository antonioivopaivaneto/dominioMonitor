<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;

class WhatsAppService implements Message
{

public function enviar( $numero, $mensagem)
{
    return Http::post('https://send.notiflow.com.br/send', [
        'numero' => $numero,
        'mensagem' => $mensagem,
    ])->json();
}




}


