<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'username' => 'max:255',
            'email' => 'email|max:255|unique:admin_users',
            'mobile' => 'unique:admin_users',
            'password' => 'required|confirmed|min:6',
        ]);

    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'string',
            'email' => 'string',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        if($request->only('email')!=null){
            session(['type'=>'email']);
            return $request->only('email', 'password');
        }
        else {
            session(['type'=>'mobile']);
            return $request->only('mobile', 'password');
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    protected function sendFailedLoginResponse(Request $request)
    {

        if(array_key_exists('email',$request->all())){
            throw ValidationException::withMessages([
                'email' => '邮箱与密码不匹配',
            ]);
        }
        else {
            throw ValidationException::withMessages([
                'mobile' => '手机号与密码不匹配',
            ]);
        }
    }
}
