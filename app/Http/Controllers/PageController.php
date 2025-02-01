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
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $pages = $user->pages()
        ->when($search,function($query) use ($search){
            $query->where('url','like',"%{$search}%");
        })->paginate(10)
        ->appends(['search'=>$search]);


        return Inertia::render('Url/index', [
            'pages' => $pages,
            'search'=>$search
        ]);
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



        //return redirect()->back()->withErrors(['error' => 'Domínio não cadastrado com sucesso.']);



        $user = Auth::user();
        $maxDomains =$user->subscription->plan->max_domains;


        if($user->dominios()->count() >= $maxDomains){
            return redirect()->back()->withErrors('Voce atingiu o limite do seu plano');
        }


        $page = Pages::create([
            'url' => $request['url'],
            'user_id' => Auth::user()->id,
            'status' => $request['status'],
            'email' => $request['email'],
            'frequency' => $request['frequency'],
            'verification_enabled' => true,
            'last_verification' => now(),
        ]);




        return redirect()->back()->with('success','Dominio cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * set enable_verificatoin for Page
     *
     * @param Request $request
     * @return void
     */
    public function setEnablePageVerify(Request $request)
    {

        $this->pageService->toogleCheckPage($request->id);

        return response()->json('sucess');
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
        $dominio = Pages::find($id);

        if ($dominio) {
            $dominio->delete();
            // Retorna uma resposta válida do Inertia com a mensagem flash de sucesso
            return redirect()->route('pages.index')->with('success', 'Domínio removido com sucesso!');
        }

        return redirect()->route('pages.index')->withErrors('error', 'Domínio não encontrado!');
    }
}
