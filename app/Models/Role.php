<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasRolesAndPermissions;
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }
}
