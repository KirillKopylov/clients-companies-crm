<?php

namespace App\Admin\Helpers;


use App\Models\Client;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

trait AdminHelper
{
    public static function formatDate(string $currentDate): string
    {
        return Carbon::parse($currentDate)->format('H:i:s d.m.Y');
    }

    public static function formatClientsDetail(Collection $items): string
    {
        return implode(', ', $items->map(function ($item) {
            return $item->full_name;
        })->toArray());
    }

    public static function formatCompaniesDetail(Collection $items): string
    {
        return implode(', ', $items->map(function ($item) {
            return $item->title;
        })->toArray());
    }

    public static function formatClientsOptions(array $items): array
    {
        $result = [];
        if (!empty($items)) {
            foreach (Client::find($items) as $client) {
                $result[$client->id] = $client->full_name;
            }
        }
        return $result;
    }

    public static function formatCompaniesOptions(array $items): array
    {
        $result = [];
        if (!empty($items)) {
            foreach (Company::find($items) as $item) {
                $result[$item->id] = $item->title;
            }
        }
        return $result;
    }
}
