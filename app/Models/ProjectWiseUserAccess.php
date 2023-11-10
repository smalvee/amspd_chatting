<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectWiseUserAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'module_id',
        'role_name',
        'create',
        'read',
        'update',
        'delete',
        'status',
        'default_access',
        'created_by'
    ];
}
