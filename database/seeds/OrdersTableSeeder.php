<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //order 1
        $order1 = new \App\Order();
        $order1->order_date = new DateTime();
        $order1->total_Price = "35";
        $order1->ust = 10;

        $user = \App\User::all()->first();
        $order1->user()->associate($user);
        $order1->save();

        $state1 = new \App\State;
        $state1->comment = 'Test';
        $state1->state = 'open';
        $state1->order()->associate($order1);
        $state1->save();

        $state2 = new \App\State;
        $state2->comment = 'second test';
        $state2->state = 'canceled';
        $state2->order()->associate($order1);
        $state2->save();

        $books = \App\Book::all();
        foreach($books as $book) {

            $order1->books()->save($book, array(
                'price' => $book['price'],
                'amount' => 3
            ));
        }

        $order1->save();

    }
}
