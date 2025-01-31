<?php

namespace App\Services;

use App\Mail\DomainExpirationWarningMail;
use App\Mail\DomainExpiryAlert;
use App\Models\Dominio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DomainService
{

    protected $messageService;

    public function __construct(Message $messageService)
    {
        $this->messageService = $messageService;

    }

    public function checkDomain()
    {

        $domains = Dominio::all();

        foreach ($domains as $domain) {
            $expirationDate = Carbon::parse($domain->expiration);
            $daysUntilExpiration = $expirationDate->diffInDays(Carbon::now());

            if ($daysUntilExpiration <= 20) {
                $this->sendEmail($domain->user->email, $domain->domain, $daysUntilExpiration);
            }
        }
    }
    public function sendEmail(string $mail, $domain, $expiration)
    {
        Mail::to($mail)
            ->send(new DomainExpirationWarningMail($domain, $expiration));
    }

    public function verificarDominioVencimento()
    {

        $today = now();

        $domains = Dominio::whereRaw('DATEDIFF(expiration, ?) <= dias_antecendencia', [$today])
        ->where('notificado', false)
        ->get();

        if ($domains->isEmpty()) {
            echo "Nenhum domínio próximo do vencimento foi encontrado.\n";
            return;
        }

        foreach ($domains as $domain) {
            try {
                Mail::to($domain->email)->send(new DomainExpiryAlert($domain));

                $this->messageService->enviar($domain->user->whatsapp, "Alerta: Seu domínio {$domain->dominio} está prestes a expirar!");

                $domain->notificado = true;
                $domain->save();

                echo "Email enviado com sucesso para {$domain->email} sobre o domínio {$domain->dominio}.\n";
            } catch (\Exception $e) {
                echo "Falha ao enviar email para {$domain->email}: {$e->getMessage()}.\n";
            }
        }
    }
}
