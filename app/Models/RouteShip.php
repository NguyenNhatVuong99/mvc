<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteShip extends Model
{
    protected $table='route_ships';
    protected $fillable=['name','description','note'];
}
