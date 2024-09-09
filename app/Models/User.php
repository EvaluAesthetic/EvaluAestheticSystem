<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
        ];
    }
    public function roles(){
        return $this->belongsToMany('App\Models\Role', 'role_user');
    }

    public function clients(){
        return $this->hasMany('App\Models\Client', 'user_id');
    }


    public function professional()
    {
        return $this->hasOne(Professional::class);
    }

    public function formatBirthday(string $type = null){
        if(!$this->birthday){
            return null;
        }
        if($type === 'string'){
            $date = Carbon::parse($this->birthday)->locale('da');

            $day = $date->day;
            $month = $date->translatedFormat('F');
            $year = $date->year;

            return "{$day}. {$month}, {$year}";
        }
        $date = Carbon::parse($this->birthday)->format('d/m/Y');
        return $date;
    }

    public function hasRole($roleId = null)
    {
        // Check for a specific role
        if ($roleId) {
            // If a single role ID is provided, check if the user has that role
            return $this->roles()->where('id', $roleId)->exists();
        }

        // If no role ID is provided, return all role IDs associated with the user
        return $this->roles()->pluck('id')->toArray();
    }
}
