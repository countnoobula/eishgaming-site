<?php

namespace App\Models;

class Clan extends BaseModel
{
    protected $fillable = ['name', 'tag', 'tag_position', 'established'];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'established',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
    }
}
