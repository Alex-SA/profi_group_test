<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        // $this->call(UsersTableSeeder::class);
        $this->call(BetTypesSeeder::class);
        $this->call(TournamentsTypesSeeder::class);
        $this->call(GameTypesSeeder::class);
    }
}
