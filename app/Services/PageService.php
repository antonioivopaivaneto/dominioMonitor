<?php

namespace App\Services;

use App\Mail\DomainExpirationWarningMail;
use App\Models\Dominio;
use App\Models\Pages;
use App\Models\Verificacoes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PageService
{




    public function checkPage(Pages $pagina)
    {

        DB::transaction();

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
    public function PreCheckPage($url)
    {

        $cleanUrl = preg_replace('#^(https?://)?(www\.)?#', '', $url); // Remove http://, https://, www.
        $cleanUrl = rtrim($cleanUrl, '/'); // Remove a barra final "/"

        try {
            $response = Http::timeout(10)->get($url);
            $status = $response->successful() ? 'funcionando' : 'fora do ar';
            $detalhes = $response->successful() ? null : $response->status();

            return[
                'status' => $status,
                'detalhes' => $detalhes,
                'url' => $cleanUrl

            ];
        } catch (\Exception $e) {
            $status = 'fora do ar';
            $detalhes = $e->getMessage();

            return[
                'status' => $status,
                'detalhes' => $detalhes,
                '$url' => $cleanUrl

            ];
        }


    }
}
