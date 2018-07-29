<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Interfaces\Profile;
use Carbon\Carbon;
use Traversable;

class UserProfile implements Profile {
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getDisplayName()
    {
        if (!empty(trim("{$this->user->display_name}"))) {
            return $this->user->display_name;
        }
        return $this->user->name;
    }

    public function getBirthday()
    {
        if (is_null($this->user->birthday)) {
            return Carbon::now();
        }

        return $this->user->birthday;
    }

    public function getEmail()
    {
        return $this->user->email;
    }

    public function getName()
    {
        return $this->user->name;
    }

    public function getPhoneNumber()
    {
        return "{$this->user->phone}";
    }

    public function getStatusLabel()
    {
        if ($this->user->is_admin) {
            return 'Verified Admin';
        }

        if ($this->user->is_gaming) {
            return 'Verified Gamer';
        }

        if ($this->user->is_profile) {
            return 'Verified User';
        }

        return 'Unverified User';
    }

    public function getClans()
    {
        return $this->user->clans;
    }

    public function getGames()
    {
        return $this->user->gameActivities;
    }

    public function inviteUrl()
    {
        if (auth()->user()->id == $this->user->id) {
            return '';
        }

        return '/';
    }
}

class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'display_name',
        'birthday',
        'phone',
        'is_admin',
        'is_gaming',
        'is_profile',
        'facebook_id',
        'steam_id',
        'steam_community_id',
        'steam_primary_clan',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    protected $casts = [
        'is_admin' => 'boolean',
        'is_gaming' => 'boolean',
        'is_profile' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'birthday',
    ];

    public function getProfile()
    {
        return new UserProfile($this);
    }
    
    public function clans()
    {
        return $this->belongsToMany(Clan::class)->withPivot('role')->withTimestamps();
    }
    
    public function gameActivities()
    {
        return $this->hasMany(GameUserActivity::class);
    }
}
