<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalToClusterMap extends Model
{
    use HasFactory;
    protected $table = 'global_to_cluster_maps';
    protected $fillable = ['id','global_uid','gname','cluster_uid','cname','created_at','updated_at'];
}
