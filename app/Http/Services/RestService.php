<?php


namespace App\Http\Services;


use App\Models\Company;
use App\Models\Client;
use Illuminate\Http\JsonResponse;

class RestService
{
    public function getCompanies(): JsonResponse
    {
        return response()->json(Company::paginate());
    }

    public function getClients(int $companyId): JsonResponse
    {
        return response()->json(Company::find($companyId)->clients()->get());
    }

    public function getClientCompanies(int $clientId): JsonResponse
    {
        return response()->json(Client::find($clientId)->companies()->get());
    }
}
