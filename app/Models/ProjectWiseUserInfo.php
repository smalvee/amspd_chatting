<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectWiseUserInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'role',
        'project_id',
        'user_id',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function permissions(){
        return $this->hasMany(RoleWisePermission::class, 'role', 'role');
    }
}
