<?php

namespace App\Http\Controllers;

use App\Models\Verificacoes;
use Illuminate\Http\Request;

class VerificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $verificacao = Verificacoes::find($id);
        if ($verificacao) {
            $verificacao->delete();
            return  redirect()->back()->with(['message' => 'Verificação excluída com sucesso.'], 200);
        } else {
            return  redirect()->back()->with(['message' => 'Verificação não encontrada.'], 404);
        }
    }
}
