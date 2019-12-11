<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
      'name', 'label', 'description', 'status', 'admin_create'
    ];

    public $timestamps = true;

    public function role()
    {
        return $this->belongsToMany('App\Models\Role', 'role_permissions', 'role_id', 'permission_id');
    }

    public function admin()
    {
        return $this->belongsToMany('App\Models\Admin', 'admin_permissions', 'admin_id', 'permission_id');
    }
}
