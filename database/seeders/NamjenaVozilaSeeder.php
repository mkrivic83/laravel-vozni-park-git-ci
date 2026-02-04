<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NamjenaVozila;

class NamjenaVozilaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Osobno','Putničko','Pomorsko'] as $n) {
        NamjenaVozila::updateOrCreate(['naziv' => $n]);
        }
    }
}
