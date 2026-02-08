<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        Lead::firstOrCreate(
            ['email' => $request->email],
            ['source' => 'pdf']
        );

        // ⚠️ Nunca retornar download aqui
        return response()->json(['success' => true]);
    }

    public function download()
    {
        return response()->download(
            public_path('Notiflow_Guia_Prevencao_Agencias.pdf'),
            'Guia_Notiflow_Agencias.pdf'
        );
    }
}
