<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategorySize;
class Size extends Model
{
    protected $table='sizes';
    protected $fillable=['name','status','category_size_id'];
    
    public function scropeStatus($query){
        return $this->query('status',1);
    }
    public function categorySize(){
        return $this->belongsTo(CategorySize::class);
    }
}
