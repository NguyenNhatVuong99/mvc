<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCondition extends Model
{
    protected $table='product_conditions';
    protected $fillable=['name','status'];
    
    public function scropeStatus($query){
        return $this->query('status',1);
    }
}
