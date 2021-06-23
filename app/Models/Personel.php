<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryWork;
use App\User;
use Illuminate\Support\Facades\Session;

class Personel extends Model
{
    protected $table = "personels";
    protected $fillable = ['user_id', 'category_work_id', 'type_salary', 'start_date', 'end_date', 'salary'];
    public function scopeStatus($query)
    {
        return $query->where("status", 1);
    }
    public function scopeBranch($query)
    {
        if(Session::has('branch')){
            $branch=Session::get('branch');
            return $query->where("branch_id", $branch->id); 
        }
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function show($user_id)
    {
        return Personel::where('user_id', $user_id)->with('categoryWork')
            ->status()
            ->firstOrFail();
    }

    public function categoryWork()
    {
        return $this->belongsTo(CategoryWork::class);
    }
    public static function datatable($request)
    {
        $role = $request->role;
        $branch = $request->branch;
        $query = User::with('roles', 'branch')->whereHas("roles", function ($q)
        {
            $q->where("isPersonel", 1);
        });
        if (isset($role) && $role != 'all')
        {
            $query = $query->role($role);
        }
        $users = $query->branch()->orderBy('id', 'desc')->get();
        $arr_id = array();
        foreach ($users as $item)
        {
            $id = $item['id'];
            array_push($arr_id, $id);
        }

        return Personel::with(['user', 'categoryWork', 'user.roles', 'user.branch'])
                        ->whereIn('user_id', $arr_id)
                        ->orderBy('id', 'desc')
                        ->get();

    }
    public static function getPersonelBranch(){
    

        $users = User::with('roles', 'branch')->branch()
        ->where('isPersonel',1)->orderBy('id', 'asc')->get();
        $arr_id = array();
        foreach ($users as $item)
        {
            $id = $item['id'];
            array_push($arr_id, $id);
        }

        return Personel::with(['user', 'categoryWork', 'user.roles'])
                        ->whereIn('user_id', $arr_id)
                        ->orderBy('id', 'asc')
                        ->get();
    }
    public static function store($request, $user_id)
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));

        $personel = new Personel();
        $personel->user_id = $user_id;
        $personel->category_work_id = $request->category_work;
        $personel->type_salary = $request->type_salary;
        $personel->salary = $request->salary;
        $personel->start_date = $start_date;
        $personel->save();
        return true;
    }
    public static function edit($code){
        $user=User::where('code',$code)->firstOrFail();
        return Personel::with(['user', 'categoryWork', 'user.roles', 'user.branch'])
                        ->where('user_id', $user->id)
                        ->first();
    }
}

