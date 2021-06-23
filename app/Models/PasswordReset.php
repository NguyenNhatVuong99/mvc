<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = [
        'email',
        'token',
    ];
    public static function updateOrCreate($email,$token){
        $data=PasswordReset::where('email',$email)->first();
        if($data){
            $data->token=$token;
            $data->save();
            return $data;
        }
        else{
            $data=new PasswordReset();
            $data->email=$email;
            $data->token=$token;
            $data->save();
            return $data;

        }
    }
}
