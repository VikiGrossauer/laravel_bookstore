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

        $order = new \App\Order();
        $order->orderNr =  "1";
        $order->price = "20";
        $order->totalPrice = "35";

        $user = \App\User::all()->first();
        $order->user()->associate($user);
        //speicher in DB
        $order->save();

        /*
        $book1 = new \App\Book;
        $book1->isbn = "12345678910";
        $book1->title = "Book";
        $book1->subtitle = "Book of Books";
        $book1->price = "20";
        $book1->published = "14.01.1997";
        $book1->rating = "8";
        $book1->description = "Hallo";
        $book1->order()->associate($order);
        $book1->save();

        $book2 = new \App\Book;
        $book2->isbn = "12345678900";
        $book2->title = "Book2";
        $book2->subtitle = "Book of Books V2";
        $book2->price = "15";
        $book2->published = "14.03.2007";
        $book2->rating = "8";
        $book2->description = "Hallo";
        $book2->order()->associate($order);
        $book2->save();*/
    }
}
