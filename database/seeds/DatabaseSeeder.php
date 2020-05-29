<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create();
        factory(App\Tweet::class, 100)->create();
        factory(App\Reply::class, 1000)->create();
        factory(App\Like::class, 5000)->create();

        // $this->call(UserSeeder::class);
    }
}
