<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = [
        'url','title'
    ];

    //da n:1 beziehung
    public function book() : BelongsTo{
        return $this->belongsTo(Book::class);
    }
}
