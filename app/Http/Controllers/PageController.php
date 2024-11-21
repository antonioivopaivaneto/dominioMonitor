<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Services\PageService;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    protected PageService $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $pages = $user->pages;


        return Inertia::render('Url/index',[
            'pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Url/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {





        $page = Pages::create([
            'url' => $request['url'],
            'user_id' => Auth::user()->id,
            'status' => $request['status'],
            'email' => $request['email'],
            'frequency' => $request['frequency'],
            'verification_enabled' => true,
            'last_verification' => now(),
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
    public function getStatusUrl(Request $request)
    {
        $url =  $request->query('url');
        $response = $this->pageService->PreCheckPage($url);

        return response()->json($response);
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
