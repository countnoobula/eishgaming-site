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
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
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
                if (!is_null($this->user->display_name)) {
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
                return Carbon::createFromDate(1994, 10, 6);
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
