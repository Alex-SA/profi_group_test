<?php

use Illuminate\Database\Seeder;

class GameTypesSeeder extends AcmeSeeder
{
    protected $table = 'game_types';
    protected $data = [
        ['name' => 'Game (type 1)'],
        ['name' => 'Game (type 2)'],
        ['name' => 'Game (type 3)'],
    ];
}
