<?php

namespace App\Models;

use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Panel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser
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
        'email_verified_at',
        'approved_at',
        'cpr',
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
            'approved_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
        ];
    }
    public function roles(){
        return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id');
    }

    public function clients(){
        return $this->hasMany(Client::class, 'user_id', 'id');
    }


    public function professional()
    {
        return $this->hasOne(Professional::class, 'user_id', 'id');
    }

    public function formatBirthday(string $type = null)
    {
        $cpr = $this->getCprAttribute($this->cpr);

        if (!$cpr) {
            return null;
        }

        $birthDateString = substr($cpr, 0, 6);
        if (strlen($birthDateString) !== 6) {
            return null;
        }

        $day = substr($birthDateString, 0, 2);
        $month = substr($birthDateString, 2, 2);
        $year = substr($birthDateString, 4, 2);

        $cutoff = 50;
        $yearPrefix = ($year >= $cutoff) ? '19' : '20';
        $year = $yearPrefix . $year;

        $date = Carbon::createFromDate($year, $month, $day);

        if (!$date) {
            return null;
        }

        if ($type === 'string') {
            $day = $date->day;
            $month = $date->translatedFormat('F');
            $year = $date->year;

            return "{$day}. {$month}, {$year}";
        }

        return $date->format('d/m/Y');
    }

    public function hasRole($roleId = null): bool
    {
        if (is_array($roleId)) {
            // Check if the user has any of the roles in the provided array
            return $this->roles()->whereIn('roles.id', $roleId)->exists();
        } elseif ($roleId) {
            // Check if the user has a single specific role
            return $this->roles()->where('roles.id', $roleId)->exists();
        }

        // If no role ID is provided, return all role IDs associated with the user
        return $this->roles()->pluck('roles.id')->toArray();
    }

    // Check if the user has any of the provided roles
    public function hasAnyRole(array $roleIds): bool
    {
        return $this->hasRole($roleIds);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Allow access for Admin role (role_id = 1)
        if ($this->hasRole(1)) {
            return true;
        }

        // Allow access for Clinic Admin role (role_id = 2) only if they are associated with a professional and clinic
        if ($this->hasRole(2) && $this->professional()->exists()) {
            return true;
        }

        // Deny access for others
        return false;
    }

    public static function getUsersByRole($roleId)
    {
        return User::whereHas('roles', function ($query) use ($roleId) {
            $query->where('role_id', $roleId);
        })->get();
    }

    public function setCprAttribute($cpr)
    {
        $this->attributes['cpr'] = Crypt::encryptString($cpr);
    }

    public function getCprAttribute($value)
    {
        if ($this->hasRole([2, 3])) {
            return Crypt::decryptString($value);
        }

        return null;
    }
}
