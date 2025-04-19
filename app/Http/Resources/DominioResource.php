<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DominioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'dominio' => $this->dominio,
            'status' => $this->status,
            'email' => $this->email,
            'expiration' => $this->expiration->format('d/m/Y'),
            'data_aviso' => $this->expiration->copy()->subDays($this->dias_antecendencia)->format('d/m/Y'),
            'dias_antecendencia' => $this->dias_antecendencia,

            'notificado' => $this->notificado,
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
