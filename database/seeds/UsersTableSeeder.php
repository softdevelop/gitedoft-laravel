<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\User::class, 4)
			->create()
			->each(function ($u) {
				$u->comments()->save(factory(App\CommentFilm::class)->make());
		    }
		);
    }
}
