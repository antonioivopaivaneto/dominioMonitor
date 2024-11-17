<?php

namespace App\Services;

use App\Mail\DomainExpirationWarningMail;
use App\Models\Dominio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

Class WhoisService  {

public function checkDomain(){

    $domains = Dominio::all();

    foreach ($domains as $domain){
        $expirationDate = Carbon::parse($domain->expiration);
        $daysUntilExpiration = $expirationDate->diffInDays(Carbon::now());

        if($daysUntilExpiration <= 20){
            $this->sendEmail($domain->user->email,$domain->domain,$daysUntilExpiration);

        }
    }

}
public function sendEmail(string $mail,$domain,$expiration){
    Mail::to($mail)
    ->send(new DomainExpirationWarningMail($domain,$expiration));

}

}
