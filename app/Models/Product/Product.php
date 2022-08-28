<?php
namespace App\Models\Product;

use App\Models\Setting\Settings;
use Illuminate\Database\Eloquent\Model;

class Product extends Model

{
    protected $guarded = array();
    protected $table = 'products';
    public function categories()
    {
        return $this->hasMany('App\Models\Product\ProductCategory', 'product_id');
    }
}








