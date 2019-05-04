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
        //test user
        $user = new \App\User;
        $user->name = 'Admin';
        $user->email = 'testuser@gmail.com';
        $user->password = bcrypt('secret');
        $user->isAdmin = true;
        $user->firstname = 'Lisa';
        $user->lastname = 'Admin';
        $user->address = 'Softwarepark 10';
        $user->plz = "4232";
        $user->city = "Hagenberg";
        $user->save();

        $user1 = new \App\User;
        $user1->name = 'Testclient';
        $user1->email = 'testclient@gmail.com';
        $user1->password = bcrypt('miau');
        $user1->isAdmin = false;
        $user1->firstname = 'Moritz';
        $user1->lastname = 'Mayr';
        $user1->address = 'Softwarepark 106';
        $user1->plz = "4232";
        $user1->city = "Hagenberg";
        $user1->save();
    }
}
