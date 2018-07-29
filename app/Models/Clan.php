<?php

namespace App\Models;

use App\Interfaces\Banner;
use App\Interfaces\Clan as ClanView;

class ClanData implements ClanView {
    private $clan;

    public function __construct(Clan $clan)
    {
        $this->clan = $clan;
    }

    public function getDisplayName()
    {
        return $this->clan->generateDisplayName($this->clan->name);
    }

    public function getEstablishedDate()
    {
        return $this->clan->established;
    }

    public function getMembers()
    {
        return $this->clan->users;
    }

    public function getMemberDisplayName(User $u)
    {
        return $this->clan->generateDisplayName($u->getProfile()->getDisplayName());
    }

    public function inviteUrl()
    {
        return '';
    }
}

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
        if ($name instanceof Banner) {
            $name = $name->getDisplayName();
        }
        
        if ($this->tag_position === 'PREPEND') {
            return "{$this->tag} {$name}";
        }
        
        return "{$name} {$this->tag}";
    }
    
    public function getClan()
    {
        return new ClanData($this);
    }
}
