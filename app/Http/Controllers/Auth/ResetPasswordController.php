<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\User;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use App\Notifications\ResetPasswordRequest;
use App\Jobs\SendResetPassword;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function index(){
        $data['banners']=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        return view('frontend.auth.password.reset',$data);
    }
    public function sendMail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = Str::random(60);
        if($user){
            $passwordReset=PasswordReset::updateOrCreate($request->email,$token);
            if ($passwordReset) {
                SendResetPassword::dispatch($user,$passwordReset->token);
            }
            return response()->json(true);
        }
        else{
            return response()->json([
                'errors'  => [
                    'Email không đúng'
                ]
            ], 402);
        }
    }

    public function reset(Request $request, $token)
    {
        dd($request->all());
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update($request->only('password'));
        $passwordReset->delete();

        return response()->json([
            'success' => $updatePasswordUser,
        ]);
    }
}
