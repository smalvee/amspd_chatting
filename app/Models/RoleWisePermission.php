<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleWisePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'created_by',
    ];
}
