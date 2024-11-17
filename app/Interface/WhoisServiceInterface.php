<?php

namespace App\Interface;

interface WhoisServiceInterface
{
    /**
     * Realiza a consulta WHOIS para um domínio.
     *
     * @param string $domain O domínio a ser consultado.
     * @return array Informações do domínio.
     */
    public function lookup(string $domain): array;
}
