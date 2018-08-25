<?php

class BetTypesSeeder extends AcmeSeeder
{
    protected $table = 'bet_types';
    protected $data = [
            ['name' => 'win'],
            ['name' => 'lose'],
            ['name' => 'test'],
        ];
}
