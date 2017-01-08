<?php

namespace App\Models;

class GameUserActivity extends BaseModel
{
    protected $fillable = [
        'user_id',
        'game',
        'minutes_played',
        'rounds_played',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
