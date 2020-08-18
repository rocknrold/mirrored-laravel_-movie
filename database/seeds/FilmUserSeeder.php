<?php

use Illuminate\Database\Seeder;

class FilmUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FilmUser::class,10)->create();
    }
}
