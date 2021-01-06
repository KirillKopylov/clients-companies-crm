<?php


namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Services\AdminAjaxService;

class AdminAjaxController
{
    private $adminAjaxService;
    private $query;

    public function __construct(AdminAjaxService $adminAjaxService, Request $request)
    {
        $this->adminAjaxService = $adminAjaxService;
        $this->query = (string)$request->q;
    }

    public function getClients(): JsonResponse
    {
        return $this->adminAjaxService->getClients($this->query);
    }

    public function getCompanies(): JsonResponse
    {
        return $this->adminAjaxService->getCompanies($this->query);
    }
}
