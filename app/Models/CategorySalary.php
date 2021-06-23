<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySalary extends Model
{
    protected $table='category_salarys';
    protected $fillable=['type_category','status','category_work_id','role_id','basic','increase','month'];
    public function scopeStatus($query){
        return $query->where('status', '1');
    }
}
