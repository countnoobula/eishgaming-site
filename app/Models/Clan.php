<?php

namespace App\Models;

use App\Interfaces\Profile;

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
    
    public function generateDisplayName($name)
    {
        if ($name instanceof Profile) {
            $name = $name->getDisplayName();
        }
        
        if ($this->tag_position === 'PREPEND') {
            return "{$this->tag} {$name}";
        }
        
        return "{$name} {$this->tag}";
    }
}
