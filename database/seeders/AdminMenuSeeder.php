<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\Menu;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'title' => __('admin.companies'),
            'icon' => 'fa-building',
            'uri' => '/companies'
        ]);
        Menu::create([
            'title' => __('admin.clients'),
            'icon' => 'fa-user',
            'uri' => '/clients'
        ]);
    }
}
