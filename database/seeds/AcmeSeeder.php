<?php

use Illuminate\Database\Seeder;

abstract class AcmeSeeder extends Seeder
{
    public function run()
    {
        if (! isset($this->table)) {
            throw new Exception('No table specified');
        }
        if (! isset($this->data)) {
            throw new Exception('No data specified');
        }

        DB::table($this->table)->truncate();
        DB::table($this->table)->insert($this->data);
    }
}
