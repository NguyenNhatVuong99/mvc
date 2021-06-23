<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceListPromotion extends Model
{
    protected $table = "price_list_promotions";
    protected $fillable = ['price_list_id', 'start_date', 'end_date','category_price', 'parent_price', 'calculation', 'value', 'type','category_product'];
    public function scopeDefault($query)
    {
        return $query->where("default", 1);
    }
}
