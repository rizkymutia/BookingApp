<?php
// App\Models\User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'name',
        'ruang',
        'jam_mulai',
        'jam_selesai',
        'tanggal',
    
    ];

    protected $permissions = [
        'user.dashboard',
    ];

    protected $roles = [
        'user',
    ];

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions);
    }

    public function hasRole($role)
    {
        return in_array($role, $this->roles);
    }

    public function userData()
    {
    return $this->hasOne(UserData::class, 'user_id');
    }

}