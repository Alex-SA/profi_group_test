<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $tournament_types
 * @property mixed $game_types
 */
class Tournaments extends Model
{
    /**
     * Get type for tournament
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tournament_types(){
        return $this->hasOne('App\Models\Types\TournamentTypes', 'id', 'tournament_types_id');
    }

    /**
     * Get type  of game for tournament
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function game_types(){
        return $this->hasOne('App\Models\Types\GameTypes', 'id', 'game_types_id');
    }
}
