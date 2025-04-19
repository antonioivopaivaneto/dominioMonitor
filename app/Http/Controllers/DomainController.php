<?php

namespace App\Http\Controllers;

use App\Http\Resources\DominioResource;
use App\Models\Dominio;
use App\Services\WhoisService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Twilio\Domain;

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
    public function index(Request $request)
    {
        $user = Auth::user();


        $search = $request->input('search');

        $dominios = $user->dominios()
        ->when($search,function($query) use ($search){
            $query->where('dominio','like',"%{$search}%");
        })->paginate(10)
        ->appends(['search'=>$search]);




        return Inertia::render('Domain/index',[
            'dominios' => DominioResource::collection($dominios),
            'search' => $search
        ]);
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

        $data['expirationDate'] = Carbon::createFromFormat('d/m/Y',$data['expirationDate'])->format('Y-m-d');

        $user = Auth::user();

        $maxDomains =$user->subscription->plan->max_domains;


        if($user->dominios()->count() >= $maxDomains){
            return redirect()->back()->withErrors('Voce atinjiu o limite do seu plano');
        }

        $dominio = $user->dominios()->create([
            'dominio' => $data['domain'],
            'expiration' => $data['expirationDate'],
            'dias_antecendencia' => $data['anticipationDays'],
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
        $dominio = Dominio::find($id);
        return Inertia::render('Domain/editDomain',compact('dominio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $dominio = Dominio::find($id);

        if ($dominio) {
            $dominio->delete();
            // Retorna uma resposta válida do Inertia com a mensagem flash de sucesso
            return redirect()->route('domain.index')->with('success', 'Domínio removido com sucesso!');
        }

        return redirect()->route('domain.index')->with('error', 'Domínio não encontrado!');

    }
}
