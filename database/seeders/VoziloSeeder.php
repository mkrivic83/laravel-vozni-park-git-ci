<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vozilo;

class VoziloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vozilo::updateOrCreate(
        ['registracija' => 'ZG2113EV'],
        ['naziv'=>'BMW','tip'=>'320D','motor'=>'dizel','istek_registracije'=>'2026-10-25','namjenaid'=>1]
        );

        Vozilo::updateOrCreate(
            ['registracija' => 'ST211DT'],
            ['naziv'=>'Iveco','tip'=>'515i','motor'=>'dizel','istek_registracije'=>'2026-04-20','namjenaid'=>2]
        );

        Vozilo::updateOrCreate(
            ['registracija' => 'RI100AA'],
            ['naziv'=>'VW','tip'=>'Golf','motor'=>'benzin','istek_registracije'=>'2025-12-10','namjenaid'=>1]
        );

        Vozilo::updateOrCreate(
            ['registracija' => 'PU555PP'],
            ['naziv'=>'MAN','tip'=>'TGE','motor'=>'dizel','istek_registracije'=>'2026-01-05','namjenaid'=>2]
        );

        Vozilo::updateOrCreate(
            ['registracija' => 'ZD777ZZ'],
            ['naziv'=>'Brod','tip'=>'Yacht','motor'=>'diesel','istek_registracije'=>'2026-08-01','namjenaid'=>3]
        );
        }
}
