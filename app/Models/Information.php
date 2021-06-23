<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table='informations';
    protected $fillable=['description','photo','address','phone','email','logo'];
}
