<?php

namespace App\Services;

use App\Mail\DomainExpirationWarningMail;
use App\Mail\PageDownAlertMail;
use App\Models\Dominio;
use App\Models\Pages;
use App\Models\Verificacoes;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PageService
{




    public function checkPage(Pages $pagina)
    {

        DB::beginTransaction();

        try {
            $response = Http::timeout(10)->get($pagina->url);
            $status = $response->successful() ? 'funcionando' : 'fora do ar';
            $detalhes = $response->successful() ? null : $response->status();
        } catch (\Exception $e) {
            $status = 'fora do ar';
            $detalhes = $e->getMessage();
        }

        try {
            Verificacoes::create([
                'page_id' => $pagina->id,
                'status' => $status,
                'detalhes' => $detalhes,
                'verificado_em' => now(),
            ]);

            $pagina->update([
                'status' => $status,
                'last_verification' => now()
            ]);





            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erro ao salvar verificacao para url {$pagina->url} : {$e->getMessage()}");
            throw $e;
        }
    }

    public function verificarTodasPaginas(){

        $paginas = Pages::where('verification_enabled', true)->get();

        if($paginas->isEmpty()){

            return false;

        }


        foreach ($paginas as $pagina){
            $this->checkPage($pagina);
        }

        if($pagina->status ==='fora do ar'){
            $this->sendPageDownAlert($pagina);
        }


    }

    public function sendPageDownAlert(Pages $pagina)
    {
        Mail::to($pagina->email)
        ->send(new PageDownAlertMail($pagina));

    }




    public function PreCheckPage($url)
    {
        $cleanUrl = preg_replace('#^(https?://)?(www\.)?#', '', $url);
        $cleanUrl = rtrim($cleanUrl, '/');

        $client = new Client([
            'timeout' => 10,       // Timeout de 10 segundos
            'verify' => false      // Desabilita a verificação de certificado SSL
        ]);

        try {

            $response = $client->get($url, [
                'on_stats' => function (\GuzzleHttp\TransferStats $stats) use (&$responseTime) {
                    // Captura o tempo de resposta da requisição
                    $responseTime = round($stats->getTransferTime(), 3);

                    if ($responseTime < 1) {
                        $responseTime = round($responseTime * 1000, 0) . ' ms';
                    } elseif ($responseTime >= 1 && $responseTime < 60) {
                        $responseTime = round($responseTime, 2) . ' s';
                    } else {
                        $responseTime = round($responseTime / 60, 2) . ' min';
                    }
                }
            ]);

            $status = $response->getStatusCode() === 200 ? 'funcionando' : 'fora do ar';
            $detalhes = null;


            return [
                'status' => $status,
                'detalhes' => $detalhes,
                'url' => $cleanUrl,
                'response_time' => $responseTime // Retorna o tempo de resposta

            ];
        } catch (\Exception $e) {
            $status = 'fora do ar';
            $detalhes = $e->getMessage();

            return [
                'status' => $status,
                'detalhes' => $detalhes,
                'url' => $cleanUrl

            ];
        }
    }
}
