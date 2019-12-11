<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id', 'pro_code', 'pro_avatar', 'pro_name', 'pro_slug', 'pro_seo_description', 'pro_seo_keyword',
        'pro_status', 'admin_create', 'type_pro_id', 'brand_id'
    ];

    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'category_products', 'product_id', 'category_id');
    }

    public function type_product()
    {
        return $this->belongsTo('App\Models\TypeProduct', 'type_pro_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function product_details()
    {
        return $this->hasMany('App\Models\ProductDetail', 'product_id');
    }
}
