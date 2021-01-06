<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Company;

class ClientCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = Company::all();
        Client::all()->each(function ($client) use ($companies) {
            $client->companies()->attach($companies->random(5)->pluck('id')->toArray());
        });
    }
}
