<?php

namespace App\Services;

use App\Models\Dominio;
use App\Models\Pages;
use App\Models\Verificacoes;
use Auth;
use Carbon\Carbon;

class DashboardService
{

    protected $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function  countPagesWithoutErrors()
    {

        return $count = Pages::where('user_id',$this->user->id)->where('status','<>','fora do ar')->count();

    }
    public function  CountDomain()
    {
        return $count = Dominio::where('user_id',$this->user->id)->count();

    }
    public function  countPagesWithErrors()
    {
        return $count = Pages::where('user_id',$this->user->id)->where('status','fora do ar')->count();

    }
    public function  totalVerifyToday()
    {
        return $count = Verificacoes::where('user_id',$this->user->id)->whereDate('verificado_em',Carbon::today())->count();

    }
    public function  getLastVerify()
    {
        $pagesIds = Pages::where('user_id',$this->user->id)->pluck('id');
        $vericacao = Verificacoes::whereIn('page_id',$pagesIds)
        ->orderBy('verificado_em','desc')
        ->first();

        return $vericacao ? $vericacao->verificado_em->format("d/m/Y H:i") : null;
    }


}
