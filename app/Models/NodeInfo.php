<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodeInfo extends Model
{
    use HasFactory;
    protected $table = "tbl_node_info";

    public function features(){
        return $this->hasMany(NodeFeature::class, 'node_id', 'node_id');
    }
}
