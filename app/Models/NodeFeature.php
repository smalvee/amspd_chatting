<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodeFeature extends Model
{
    use HasFactory;

    public $fillable = ['node_id', 'name', 'data_table_name', 'note'];
}
