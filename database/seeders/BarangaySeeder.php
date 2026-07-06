<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barangay;

class BarangaySeeder extends Seeder
{
    public function run(): void
    {
        $barangays = [
            'Del Pilar',
            'Landing',
            'Lumipac',
            'Lusot',
            'Mabini',
            'Magsaysay',
            'Misom',
            'Mitacas',
            'Naburos',
            'Northern Poblacion',
            'Punta Miray',
            'Punta Sulong',
            'Sinian',
            'Southern Poblacion',
            'Tugas',
        ];

        foreach ($barangays as $name) {
            Barangay::firstOrCreate([
                'name' => $name,
            ]);
        }
    }
}