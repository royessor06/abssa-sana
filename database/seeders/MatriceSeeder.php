<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matrice;

class MatriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matrices = [
            ['libelle' => 'Produits végétaux'],
            ['libelle' => 'Produits animaux'],
            ['libelle' => 'Produits transformés'],
            ['libelle' => 'Produits infantiles et nutritionnels sensibles'],
            ['libelle' => 'Aliments pour animaux (feed)']
        ];

        foreach ($matrices as $matrice) {
            Matrice::create($matrice);
        }
    }
}
