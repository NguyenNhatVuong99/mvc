<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceShip extends Model
{
    protected $table='service_ships';
    protected $fillable=['route_ship_id','method','weight','urban','suburban','more_weight','time'];
    public function route(){
        return $this->hasOne('App\Models\RouteShip');
    }
}
