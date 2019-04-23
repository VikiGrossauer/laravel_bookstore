<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //ein User hat mehrere Bücher
    //books da mehrere
    public function books() : HasMany {
        return $this->hasMany(Book::class);
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return ['user' => ['id'=>$this->id]];
        //im JWT Token etwas mitgeben
        //auch mitschicken ob admin oder nicht -- erweitern!
        //'isAdmin' - mappen auf richtige Spalte
    }
}
