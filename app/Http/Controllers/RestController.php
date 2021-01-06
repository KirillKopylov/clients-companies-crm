<?php


namespace App\Http\Controllers;


use App\Http\Services\RestService;
use Illuminate\Http\JsonResponse;

class RestController
{
    private $restService;

    public function __construct(RestService $restService)
    {
        $this->restService = $restService;
    }

    public function getCompanies(): JsonResponse
    {
        return $this->restService->getCompanies();
    }

    public function getClients(int $companyId): JsonResponse
    {
        return $this->restService->getClients($companyId);
    }

    public function getClientCompanies(int $clientId): JsonResponse
    {
        return $this->restService->getClientCompanies($clientId);
    }
}
