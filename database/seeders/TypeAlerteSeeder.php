<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeAlerte;

class TypeAlerteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $typesAlertes = [
            ['nom_alerte' => 'Alertes biologiques'],
            ['nom_alerte' => 'Alertes chimiques'],
            ['nom_alerte' => 'Alertes physiques'],
            ['nom_alerte' => 'Alertes nutritionnelles (sensibles)'],
            ['nom_alerte' => 'Alertes import/export']
        ];

        foreach ($typesAlertes as $type) {
            TypeAlerte::create($type);
        }
    }
}
