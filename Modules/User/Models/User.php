<?php

namespace Modules\User\Models;

use BezhanSalleh\FilamentShield\Support\Utils;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasRoles;
    use HasPanelShield;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email','phone_number', 'status','email_verified_at','img'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ACTIVE_STATUS = 'active';
    const INACTIVE_STATUS = 'inactive';

    public static $statuses = [
        self::ACTIVE_STATUS,
        self::INACTIVE_STATUS
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(Utils::getSuperAdminName());
    }

    public function getFilamentName(): string
    {
        return $this->name ?? '';
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }
}
