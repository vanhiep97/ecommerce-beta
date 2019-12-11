<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";

    protected $fillable = [
        'br_image', 'br_name', 'br_slug', 'br_description', 'br_seo_description', 'br_seo_keyword', 'br_status', 'admin_create'
    ];

    public $timestamps = true;

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'brand_id');
    }
}
