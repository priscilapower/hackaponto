<?php

use Illuminate\Database\Seeder;

class PontosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Ponto::class, 500)->create();
    }
}
