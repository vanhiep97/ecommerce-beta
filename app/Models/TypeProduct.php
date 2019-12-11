<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    protected $table = 'type_products';

    protected $fillable = [
      'tp_image', 'tp_name', 'tp_slug', 'tp_status', 'admin_create'
    ];

    public $timestamps = true;

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'type_pro_id');
    }
}
