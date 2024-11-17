<?php

use App\Services\WhoisService;

it('should return domain information on valid lookup', function () {
    // Instanciando o serviço Whois
    $whoisService = new WhoisService();

    // Chamando o método lookup para um domínio válido
    $result = $whoisService->lookup('safetyfacilities.com.br');

    dd($result);

    // Verificando se o retorno é um array com as informações esperadas
    expect($result)->toBeArray();
    expect($result)->toHaveKey('domainName');
    expect($result)->toHaveKey('expirationDate');
});
