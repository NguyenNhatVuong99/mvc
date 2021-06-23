<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Personel;
class DetailSalary extends Model
{
    protected $table='detail_salaries';
    protected $fillable=['salary_id','personel_id','hour','late','basic_salary','sub_salary','advance_salary','receipt_id','bonus_salary','total_salary','dedution_salary','note','status'];
    public static function store($item){
        $detail=new DetailSalary();
        $detail->salary_id=$item['salary_id'];
        $detail->personel_id=$item['personel_id'];
        $detail->hour=$item['hour'];
        $detail->late=$item['late'];
        $detail->basic_salary=$item['basic_salary'];
        $detail->sub_salary=$item['sub_salary'];
        $detail->advance_salary=$item['advance_salary'];
        $detail->receipt_id=$item['receipt_id'];
        $detail->bonus_salary=$item['bonus_salary'];
        $detail->total_salary=$item['sum_salary'];
        $detail->dedution_salary=$item['dedution_salary'];
        $detail->save();
    }
    public static function updateDetail($item){
        $detail=DetailSalary::find($item['id']);
        $detail->salary_id=$item['salary_id'];
        $detail->personel_id=$item['personel_id'];
        $detail->hour=$item['hour'];
        $detail->late=$item['late'];
        $detail->basic_salary=$item['basic_salary'];
        $detail->sub_salary=$item['sub_salary'];
        $detail->advance_salary=$item['advance_salary'];
        $detail->receipt_id=$item['receipt_id'];
        $detail->bonus_salary=$item['bonus_salary'];
        $detail->total_salary=$item['sum_salary'];
        $detail->dedution_salary=$item['dedution_salary'];
        $detail->save();
    }

    public function personel()
    {
        return $this->belongsTo(Personel::class);
    }
}
