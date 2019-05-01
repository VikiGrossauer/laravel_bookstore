<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('books')->insert([
           'title' => 'Herr der Ringe',
           'isbn' => '1234567800',
           'subtitle' => 'Rückkehr des Königs',
           'rating' => 10,
           'description' => 'Letzter Teil der Triologie',
            'published' => new DateTime()
        ]);*/

        $book = new \App\Book();
        $book->title = "Herr der Ringe";
        $book->isbn = '1234567800';
        $book->subtitle = 'Rückkehr des Königs';
        $book->rating = 10;
        $book->description = 'Letzter Teil der Triologie';
        $book->published = new DateTime();
        $book->price = 10;

        //get the first user
        //1-n beziehung
        $user = \App\User::all()->first();
        $book->user()->associate($user);
        //speicher in DB
        $book->save();

        //alle Authore
        //pluck sammelt alle Werte der Spalte in Array
        //m-n beziehungen
        $authors = \App\Author::all()->pluck("id");
        $book->authors()->sync($authors);

        //add imeages to book
        $image1 = new \App\Image;
        $image1->title = "Cover1";
        $image1->url = "https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?cs=srgb&dl=animal-animal-photography-cat-104827.jpg&fm=jpg";
        $image1->book()->associate($book);
        $image1->save();

        $image2 = new \App\Image;
        $image2->title = "Cover2";
        $image2->url = "https://images.pexels.com/photos/416160/pexels-photo-416160.jpeg?cs=srgb&dl=animal-cat-face-close-up-416160.jpg&fm=jpg";
        $image2->book()->associate($book);
        $image2->save();

        /*
        //update
        $book = App\Book::find(1);
        $book->title = "Neuer Title";
        $book->save();

        //delete
        $book->delete();

        //findOrCreate updateOrCreate
        $book = App\Book::findOrCreate(['title'=>"Buchtitle"]);

        $book = App\Book::updateOrCreate(['title'=>'Buchtitle'],['description'=>"Neue Beschreibung"]);


        //element in Beziehung einfügen
        $book->images()->save($image);
        $book->images()->saveMany([$image1,$image2]);

        //user hinzufügen - also 1 seite setzen
        $book->user()->associate($user1);
        $book->save();

        //user wieder wegnehmen
        $book->user()->dissociate($user1);
        $book->save();

        //m:n Beziehungen
        $book->authors()->attach($authorId);
        //löscht author
        $book->authors()->detach($authorId);
        //löscht alle authoren der Beziehung
        $book->authors()->detach();

        //nur mehr diese drei in Tabelle - also hinzufügen oder rausschmeißen
        $book->authors()->sync([1,2,3]);
        */

    }
}
