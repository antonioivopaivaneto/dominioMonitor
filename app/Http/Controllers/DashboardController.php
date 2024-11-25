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
    $pages = $this->service->countPagesWithoutErrors();
    $domains = $this->service->CountDomain();
    $verifyWithErrors = $this->service->countPagesWithErrors();
    $lastVerify = $this->service->getLastVerify();

    return Inertia::render('Dashboard',compact(
        'pages',
        'domains',
        'verifyWithErrors',
        'lastVerify'
    ));
}

}
