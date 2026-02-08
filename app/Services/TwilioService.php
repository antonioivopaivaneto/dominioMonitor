<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService implements Message
{
    public function enviar( $numero, $mensagem)
    {
        $twilioNumber = 'whatsapp:+14155238886'; // Número oficial do Twilio

        $client = new Client(env('TWILIO_SID'),env('TWILIO_TOKEN'));
        $client->messages->create(
            "whatsapp:{$numero}",
            [
                'from' => $twilioNumber,
                'body' => $mensagem,
            ]
        );

        return "Mensagem enviada para {$numero}!";


    }



}
