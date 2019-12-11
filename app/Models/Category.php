<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'cat_image', 'cat_name', 'cat_slug', 'cat_parent_id',
        'cat_description', 'cat_seo_description', 'cat_seo_keyword',
        'cat_status', 'admin_create'
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'category_products', 'category_id', 'product_id');
    }
}
