<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Personel;
use App\Models\Shift;
use App\User;
use Carbon\Carbon;

class Timesheet extends Model
{
    protected $table='timesheets';
    protected $fillable=(['personel_id','shift_id','branch_id','date','check_in','holiday_id','check_out','isLate','latencies','note','status']);
    public static function store($id){
        $user=User::find($id);
        $personel=Personel::where('user_id',$user->id)->first();
        $branch_id=$user->branch_id;
        $datetime=Carbon::now();
        $date= $datetime->format('Y-m-d');
        $time= $datetime->format('H:i:s');
        $shift_id=Shift::checkShift($time);
        $holiday_id=Holiday::checkHoliday($date);
        $timesheet = Timesheet::where([
                                    'personel_id' =>$personel->id,
                                    'shift_id' => $shift_id,
                                    'date'=>$date
                            ])->first();
        if($timesheet==null){
            Shift::isLate($time,$shift_id);

            $timesheet= new Timesheet();
            $timesheet->personel_id=$personel->id;
            $timesheet->shift_id=$shift_id;
            $timesheet->branch_id=$branch_id;
            $timesheet->check=$personel->id;
            $timesheet->personel_id=$personel->id;

        }                  
        
    }
}