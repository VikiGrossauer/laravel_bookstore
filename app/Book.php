<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    //wenn anderer name
    //protected $table = 'name_der_tabelle';

    //wenn nicht primaryKey
    //protected $primaryKey = 'name_der_pk_col';

    //diese Spalten dürfen geändert werden
    protected $fillable = ['isbn','title','subtitle', 'price', 'published',
        'rating','description','user_id'];

    //QueryScope
    //müssen mit scope anfangen und query mitbekommen
    public function scopeFavourite($query){

        //Where: 1. Spalte, 2. ??, 3. Wert
        return $query->where('rating', '>=', 8);
    }

    //ein Buch hat mehrere Bilder
    //images da ja mehrere
    public function images() : HasMany {
        return $this->hasMany(Image::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function authors() : BelongsToMany {
        return $this->belongsToMany(Author::class);
    }

    public function order() : BelongsTo{
        return $this->belongsTo(Order::class);
    }

}
