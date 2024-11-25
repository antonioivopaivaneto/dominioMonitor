<?php

namespace App\Services;

use App\Models\Dominio;
use App\Models\Pages;
use App\Models\Verificacoes;
use Auth;
use Carbon\Carbon;

class DashboardService
{

    public function  CountPage()
    {

        return $count = Pages::where('user_id',Auth::user()->id)->where('status','<>','fora do ar')->count();

    }
    public function  CountDomain()
    {
        return $count = Dominio::where('user_id',Auth::user()->id)->count();

    }
    public function  VerifyWithErros()
    {
        return $count = Pages::where('user_id',Auth::user()->id)->where('status','fora do ar')->count();

    }
    public function  totalVerifyToday()
    {
        return $count = Verificacoes::where('user_id',Auth::user()->id)->whereDate('verificado_em',Carbon::today())->count();

    }


}
