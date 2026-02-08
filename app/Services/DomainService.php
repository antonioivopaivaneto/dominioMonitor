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
    protected WhoisService $whois;


    public function __construct(Message $messageService)
    {
        $this->messageService = $messageService;
        $this->whois = new WhoisService();

    }


    private function normalizePhone(?string $phone): ?string
{
    if (!$phone) return null;

    return preg_replace('/\D/', '', $phone);
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
                $this->verifyAndUpdateDomainExpiration($domain);

                Mail::to($domain->email)->send(new DomainExpiryAlert($domain));

               try {
                   $phone = $this->normalizePhone($domain->user->whatsapp);

                    if ($phone && strlen($phone) >= 12) {
                        $this->messageService->enviar(
                            $phone,
                            "⚠️ O domínio {$domain->dominio} vence em breve."
                        );
                    } else {
                        \Log::warning('WhatsApp não enviado - telefone inválido', [
                            'original' => $domain->user->whatsapp,
                            'normalizado' => $phone,
                        ]);
                    }

                } catch (\Throwable $e) {
                    \Log::warning('Falha ao enviar WhatsApp', [
                        'domain' => $domain->dominio,
                        'error' => $e->getMessage(),
                    ]);
                }



                $domain->notificado = true;
                $domain->save();

                echo "Email enviado com sucesso para {$domain->email} sobre o domínio {$domain->dominio}.\n";
            } catch (\Exception $e) {
                echo "Falha ao enviar email para {$domain->email}: {$e->getMessage()}.\n";
            }
        }
    }


    private function verifyAndUpdateDomainExpiration(Dominio $domain)
    {
        $result =  $this->whois->lookup($domain->dominio);

        if (isset($result['expirationDate'])) {
            $domain->expiration = Carbon::createFromFormat('d/m/Y', $result['expirationDate'])->format('Y-m-d');
            $domain->status = $result['status'];
            $domain->save();
        } else {
            echo "Erro ao verificar o domínio {$domain->dominio}: {$result['error']}\n";
        }
    }
}
