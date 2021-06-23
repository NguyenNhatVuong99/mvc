<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Session;
class Salary extends Model
{
    protected $table = 'salaries';
    protected $fillable = ['month', 'year', 'name', 'slug', 'total','isPay'];
   
    public static function checkSalary(){
        $salary = Salary::get();
        $time = Carbon::now();
        $month_now = (int)Carbon::now()->format('m');
        $year_now = (int)Carbon::now()->format('Y');
        if($month_now==1){
            $month=12;
            $year=$year_now-1;
        }
        else{
            $month=$month_now-1;
            $year=$year_now;
        }
        $salary=Salary::where('month',$month)->where('year',$year)->first();
        // dd($salary);
        return $salary;
        // return Salary::where('month',$month)->where('year',$year)->first();
        
    }
    public static function createSalary()
    {
        $salary = Salary::orderBy('id','desc')->first();
        $time = Carbon::now();
        $month_now = (int)Carbon::now()->format('m');
        $year_now = (int)Carbon::now()->format('Y');
        $month;
        $year;
        if ($salary == null)
        {
            if ($month_now == 1)
            {
                $month = 12;
                $year = $year_now - 1;
            }
            else
            {
                $month = $month_now - 1;
                $year = $year_now;
            }
        }
        else
        {
            switch (true)
            {
                case ($month_now == 1 && $salary->month == 11):
                    $month = 12;
                    $year = $salary->year;
                break;
                case ($month_now == 2 && $salary->month == 12):
                    $month = 1;
                    $year = $year_now;

                break;
                case ($salary->month == $month_now - 2):
                    $month = $month_now - 1;
                    $year = $year_now;
                break;
                
            }

        }
        if(isset($month)&&isset($year)){
            $name = 'Bảng lương tháng ' . $month . '/' . $year ;
            $slug = Salary::createSlug($name);
            $salary = new Salary();
            $salary->name = $name;
            $salary->slug = $slug;
            $salary->month = $month;
            $salary->year = $year;
            $salary->save();
            return $salary;
        }
        else{
            return false;
        }
            
    }
    public static function store($request,$salary){
        $salary->total=$request->total;
        $salary->save();
        foreach($request->listSalary as $item){
            DetailSalary::store($item,$request->type);
        }
        return true;
    }
    public static function updateSalary($request,$salary){
        $salary->total=$request->total;
        $salary->save();
        foreach($request->listSalary as $item){
            DetailSalary::updateDetail($item);
        }
        return true;
    }
    public static function createSlug($title)
    {
        $replacement = '-';
        $map = array();
        $quotedReplacement = preg_quote($replacement, '/');
        $default = array(
            '/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|å/' => 'a',
            '/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|ë/' => 'e',
            '/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|î/' => 'i',
            '/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|ø/' => 'o',
            '/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|ů|û/' => 'u',
            '/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/' => 'y',
            '/đ|Đ/' => 'd',
            '/ç/' => 'c',
            '/ñ/' => 'n',
            '/ä|æ/' => 'ae',
            '/ö/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/ß/' => 'ss',
            '/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
            '/\\s+/' => $replacement,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        );
        $title = urldecode($title);
        $map = array_merge($map, $default);
        return strtolower(preg_replace(array_keys($map) , array_values($map) , $title));
    }
}
//

