<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Avatar;
use Auth;
use App\Models\Profile;
use App\Models\Branch;
use App\Models\Personel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','code','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function scopeStatus($query){
        return $query->where('status', '1');
    }
    public function scopeIsPersonel($query){
        return $query->where('isPersonel', '1');
    }

    public function personel(){
        return $this->belongsTo(Personel::class);
    }
    public function profiles(){
        return $this->hasMany(Profile::class);
    }
    public static function show($code){
        return User::where('code',$code)->with('roles','profiles')->status()->firstOrFail();
    }
    public static function store($request){
        $email=$request->email;
        if($email==''){
            $email='';
        }
        $user = new User();
        $user->email=$email;
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->code='';
        $user->password=$request->password;
        $user->save();
        $role=Role::where('name',$request->role)->first();
        $user->assignRole($request->role);
        $str=$role->code;
        $user_id=$user->id;
        $length=4;
        for($i=0; $i<$length; $i++){
            $str.='0';
        }
        $user_code=$str.$user_id;
        $user->code=$user_code;
        $user->save();
        Profile::store($request,$user_id);
        
        if($request->isPersonel==1){
            Personel::store($request,$user_id);
        }
        
    }
}
