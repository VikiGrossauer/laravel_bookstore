<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //test authoren
        $author1 = new App\Author;
        $author1->firstName = 'Max';
        $author1->lastName = 'Meier';
        $author1->save();

        $author2 = new App\Author;
        $author2->firstName = 'Lukas';
        $author2->lastName = 'Man';
        $author2->save();

        $author3 = new App\Author;
        $author3->firstName = 'Lisa';
        $author3->lastName = 'Huber';
        $author3->save();
    }
}
