<?php

namespace App\Http\Controllers;

use App\Services\WhoisService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DomainController extends Controller
{
    protected WhoisService $whois;

    public function __construct(WhoisService $whois ) {
        $this->whois = $whois;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Domain/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
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
    public function getDomainLook($domain)
    {

      $result =  $this->whois->lookup($domain);

      return response()->json( $result);

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
