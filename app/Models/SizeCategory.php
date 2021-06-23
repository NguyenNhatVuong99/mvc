<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeCategory extends Model
{
    protected $table='size_categories';
    protected $fillable=['name','status'];
    
    public function scropeStatus($query){
        return $this->query('status',1);
    }
}
