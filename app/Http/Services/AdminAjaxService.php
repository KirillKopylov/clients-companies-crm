<?php


namespace App\Http\Services;


use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AdminAjaxService
{
    public function getClients(string $query): JsonResponse
    {
        return response()->json(
            Client::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%$query%")
            ->select(DB::raw("id, CONCAT(`first_name`, ' ', `last_name`) as text"))
            ->paginate()
        );
    }

    public function getCompanies(string $query): JsonResponse
    {
        return response()->json(Company::where('title', 'LIKE', "%$query%")->paginate(null, ['id', 'title as text']));
    }
}
