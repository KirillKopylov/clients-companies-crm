<?php


namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Services\AdminAjaxService;

class AdminAjaxController
{
    private $adminAjaxService;
    private $request;

    public function __construct(AdminAjaxService $adminAjaxService, Request $request)
    {
        $this->adminAjaxService = $adminAjaxService;
        $this->request = $request;
    }

    public function getClients(): JsonResponse
    {
        return $this->adminAjaxService->getClients($this->request->q);
    }

    public function getCompanies(): JsonResponse
    {
        return $this->adminAjaxService->getCompanies($this->request->q);
    }
}
