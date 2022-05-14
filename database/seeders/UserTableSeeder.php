<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Article;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->count(20000)->create()->each(function($user){
            $user->articles()->saveMany(Article::factory()->count(20)->make());
        });
    }
}
