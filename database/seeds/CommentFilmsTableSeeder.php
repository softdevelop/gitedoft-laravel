<?php

use Illuminate\Database\Seeder;

class CommentFilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\CommentFilm::class,3)->create();
    }
}
