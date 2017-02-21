<?php

namespace App\Models;

use Carbon\Carbon;
use Traversable;
use App\Interfaces\Banner;
use App\Interfaces\Clan as ClanView;

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
    
    public function getClan(): ClanView
    {
        return new class($this) implements ClanView {
            private $clan;
            
            public function __construct(Clan $clan)
            {
                $this->clan = $clan;
            }
            
            public function getDisplayName(): string
            {
                return $this->clan->generateDisplayName($this->clan->name);
            }
            
            public function getEstablishedDate(): Carbon
            {
                return $this->clan->established;
            }
            
            public function getMembers(): Traversable
            {
                return $this->clan->users;
            }
            
            public function getMemberDisplayName(User $u): string
            {
                return $this->clan->generateDisplayName($u->getProfile()->getDisplayName());
            }
            
            public function inviteUrl(): string
            {
                return '';
            }
        };
    }
}
