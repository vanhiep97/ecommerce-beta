<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_details';

    protected $fillable = [
        'product_id', 'prd_price', 'prd_percent_discount', 'prd_gallery',
        'prd_excerpt', 'prd_content'
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
