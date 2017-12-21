<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

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

    public function getSocialRedirect($account){
        try{
            return Socialite::with( $account )->redirect();
        }catch ( \InvalidArgumentException $e ){
            return redirect('/login');
        }
    }

    public function getSocialCallback( $account ){

    }

   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
