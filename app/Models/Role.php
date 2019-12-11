<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name', 'label', 'description', 'status', 'admin_create'
    ];

    public $timestamps = true;

    public function admins()
    {
        return $this->hasMany('App\Models\Admin', 'role_id');
    }

    public function permission()
    {
        return $this->belongsToMany('App\Models\Permission', 'role_permissions', 'role_id', 'permission_id');
    }
}
