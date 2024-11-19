<?php

namespace App\Services;

use App\Interface\WhoisServiceInterface;
use Carbon\Carbon;
use Exception;
use Iodev\Whois\Factory;

Class WhoisService implements WhoisServiceInterface{

    protected $whois;

    public function __construct(){
        $this->whois = Factory::get()->createWhois();
    }


     /**
     * Realiza a consulta WHOIS para um domínio.
     *
     * @param string $domain O domínio a ser consultado.
     * @return array Informações do domínio.
     */
    public function lookup(string $domain): array
    {
        try{
            $info = $this->whois->loadDomainInfo($domain);

            if($info){


                $expirationDate = Carbon::createFromTimestamp($info->getExpirationDate());


                return[
                    'domainName' => $info->getDomainName(),
                    'expirationDate' => $expirationDate->format('d/m/Y'),
                    'responsible' => $info->getOwner(),
                    'status' => $info->getStates()
                ];

            }
        }catch(Exception $e){
            return ['error' =>$e->getMessage()];
        }

    }
}
