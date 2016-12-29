<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Interfaces\Profile;
use Carbon\Carbon;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

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
    protected $fillable = ['name', 'email', 'password', 'display_name', 'birthday', 'phone',];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'birthday',
    ];

    public function getProfile(): Profile
    {
        return new class($this) implements Profile {
            private $user;
            
            public function __construct(User $user)
            {
                $this->user = $user;
            }
            
            public function getDisplayName(): string
            {
                if (!empty(trim("{$this->user->display_name}"))) {
                    return $this->user->display_name;
                }
                return $this->user->name;
            }

            public function getTag(): string
            {
                return 'E G N';
            }

            public function getBirthday(): Carbon
            {
                if (is_null($this->user->birthday)) {
                    return Carbon::now();
                }
                
                return $this->user->birthday;
            }

            public function getEmail(): string
            {
                return $this->user->email;
            }

            public function getName(): string
            {
                return $this->user->name;
            }

            public function getPhoneNumber(): string
            {
                return "{$this->user->phone}";
            }

            public function getStatusLabel(): string
            {
                return 'Unverified User';
            }
        };
    }
}
