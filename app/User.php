<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed $bets
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'social_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Identify exist user from social networks
     *
     * @param $input
     * @return $this|\Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function addNewFromSocial($input)
    {
//        check exist  user from current social network
        $check = static::where('social_id', $input['social_id'])->first();
        if(is_null($check)) {
//        check exist user with current email (email is unique field)
            $check = static::where('email', $input['email'])->first();
        }
        if(is_null($check)){
//            create new user
            return static::create($input);
        }
        return $check;
    }

    /**
     * Get user`s bets collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bets(){
        return $this->hasMany('App\Models\Bets')
            ->with('bet_types')
            ->with('game_types')
            ->orderBy("game_types_id")
            ->orderBy("amount");
    }
}
