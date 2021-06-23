<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailDebt extends Model
{
    protected $table='detail_debts';
    protected $fillable=['debt_id','order_id','receipt_id','receipt_stock_id','no_phat_sinh','co_phat_sinh'];

}
