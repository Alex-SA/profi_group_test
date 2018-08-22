<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $game_types
 * @property mixed $bet_types
 */
class Bets extends Model
{
    protected $fillable = [
        'user_id', 'bet_types_id', 'amount', 'game_types_id',
    ];

    /**
     * Get type of game for bet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function game_types(){
        return $this->hasOne('App\Models\Types\GameTypes', 'id', 'game_types_id');
    }

    /**
     * Get bet type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bet_types(){
        return $this->hasOne('App\Models\Types\BetTypes', 'id', 'bet_types_id');
    }

}
