<?php

use Illuminate\Database\Seeder;

class TournamentsTypesSeeder extends AcmeSeeder
{
    protected $table = 'tournament_types';
    protected $data = [
        ['name' => '1x1'],
        ['name' => '5x5'],
        ['name' => '10x10'],
    ];
}
