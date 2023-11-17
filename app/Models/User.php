<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'status',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function projectWiseUserInfos()
    {
        return $this->hasMany(ProjectWiseUserInfo::class, 'user_id', 'id');
    }

    public function access($permission, $module = null, $project_id = null)
    {
        switch ($permission) {
            case 'Super Admin':
                return ($this->type == 'Super Admin') ? true : false;
                break;
            case 'Admin':
                return ($this->type == 'Admin' || $this->type == 'Super Admin') ? true : false;
                break;
            case 'User':
                return ($this->type == 'User' || $this->type == 'Admin' || $this->type == 'Super Admin') ? true : false;
                break;
            default:
                if ($this->type == 'Admin' || $this->type == 'Super Admin') {
                    return true;
                } else {
                    return $this->projectWiseUserInfos()->where('project_id', $project_id)->whereHas('permissions', function ($query) use ($module, $permission) {
                        $query->whereModule($module)->wherePermission($permission);
                    })->count() ? true : false;
                }
        }
    }
}
