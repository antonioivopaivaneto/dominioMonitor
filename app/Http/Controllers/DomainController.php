<?php

namespace App\Http\Controllers;

use App\Services\WhoisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DomainController extends Controller
{
    protected WhoisService $whois;

    public function __construct(WhoisService $whois)
    {
        $this->whois = $whois;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $dominios = $user->dominios;


        return Inertia::render('Domain/index',[
            'dominios' => $dominios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Domain/create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['status'] = is_array($data['status']) ? $data['status'][0] : $data['status'];


        $user = Auth::user();

        $dominio = $user->dominios()->create([
            'dominio' => $data['domain'],
            'expiration' => $data['expirationDate'],
            'status' => $data['status'],
            'email' => $data['email'],
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function getDomainLook(Request $request)
    {
        $domain = $request->query('domain');

        $cleanDomain = preg_replace('/^https?:\/\//', '', rtrim($domain, '/'));

        $result =  $this->whois->lookup($cleanDomain);

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        //
    }
}
