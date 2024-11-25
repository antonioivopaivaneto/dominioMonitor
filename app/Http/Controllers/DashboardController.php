<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{

    protected DashboardService $service;

    public function __construct(DashboardService $service) {
        $this->service = $service;
    }
public function index(){
    $pages = $this->service->CountPage();
    $domains = $this->service->CountDomain();
    $verifyWithErrors = $this->service->VerifyWithErros();

    return Inertia::render('Dashboard',compact('pages','domains','verifyWithErrors'));
}

}
