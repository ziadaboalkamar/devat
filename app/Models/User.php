<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'firstname',
        'lastname',
        'jobName',
        'email',
        'phoneNumber',
        'password',
        'role_id',
        'branch_id',
        'userName',
        'updated_at',
        'status',
        'created_at',
        'setting_status',
    ];

    protected $appends = ['full_name'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function getFullNameAttribute(): string
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id','id');
    }

    public function branches()
    {
        return $this->belongsTo(Branches::class, 'branch_id','id');
    }
    public function route()
    {
        return $this->belongsToMany(Route::class, 'user_route','user_id','route_id');
    }
    public function getActive(){
        return $this->status == 0 ? __(' غير فعال ') : __('فعال') ;
    }

    public function hasAbility($permissions) 
    {
        $role = $this->role;

        if (!$role) {
            return false;
        }

        foreach ($role->permissions as $permission) {
            if (is_array($permissions) && in_array($permission, $permissions)) {
                return true;
            } else if (is_string($permissions) && strcmp($permissions, $permission) == 0) {
                return true;
            }
        }
        return false;
    }
}
