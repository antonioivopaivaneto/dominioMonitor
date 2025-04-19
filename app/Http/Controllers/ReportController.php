<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    public function index()
    {

        return Inertia::render('report/index');

    }
    public function show()
{
    // Páginas Fora do Ar
    $offlinePages = Pages::where('status', 'fora do ar')->get();

    // Melhores Páginas (Baseado no tempo - por exemplo, tempo desde a última verificação)
    $bestPages = Pages::withCount('verificacoes')
        ->orderBy('verificacoes_count', 'desc')
        ->get();

    // Piores Páginas (Baseado no número de falhas)
    $worstPages = Pages::withCount(['verificacoes' => function ($query) {
        $query->where('status', 'falha');
    }])->orderBy('verificacoes_count', 'desc')
        ->get();

    // Páginas Regulares
    $pages = Pages::all();

    return Inertia::render('report/Reports', [
        'pages' => $pages,
        'offlinePages' => $offlinePages,
        'bestPages' => $bestPages,
        'worstPages' => $worstPages,
    ]);
}

}
