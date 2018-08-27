<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\Resource;

class BetsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

/**
 *      Example of adding other information to the collection
 */
    public function with($request)
    {
// Get user data
        $user = User::findOrFail($this[0]->user_id);
        return array(
            'version' => '0.0.1',
            'mode' => 'test bets API',
            'user_data' => new UsersResource($user)
        );
    }
}
