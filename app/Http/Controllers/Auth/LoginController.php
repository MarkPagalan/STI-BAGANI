<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

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
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


     public function authenticated(Request $request,$user)
     {
     // Logic that determines where to send the user
        
        //if ($user->verified == 0) {
      ///      auth()->logout();
//return back()->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
       // }
       // else{

            if($request->user()->hasRole('ROLE_ADMIN')){
               // dd($request->all());
                return redirect('/home');
             }
             if($request->user()->hasRole('ROLE_SUPERADMIN')){
                //dd("No");
                
                return redirect('/dashboard');
                //return View::make('dashboard.dashboard');
             }
       //}
             //dd("Yes");
        return redirect()->intended($this->redirectPath());
        
     }
}
