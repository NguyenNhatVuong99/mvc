<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table='shippings';
    protected $fillable=['name','cod','fee','quantity'];
}
