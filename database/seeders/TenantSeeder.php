<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Tenant::create([
            'name' => 'Demo Company',
            'domain' => 'demo',
            'active' => true,
            'settings' => [
                'timezone' => 'America/Sao_Paulo',
                'currency' => 'BRL',
                'date_format' => 'd/m/Y',
            ],
        ]);
    }
}
