<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Billings;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;    
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('dashboard.dashboard');

        $users1 = DB::table('roles')
            ->join('roleusers', 'roles.id', '=', 'roleusers.role_id')
            ->join('users', 'roleusers.user_id', '=', 'users.id')
            ->where('roles.id','=','2')
            ->get();

        $viewmeter = DB::table('waterlevels')
            ->select('waterlevels.waterlevel as waterlevel','waterlevels.created_at','users.id as id')
            ->join('users', 'waterlevels.user_id', '=', 'users.id')
            ->where('waterlevels.waterlevel','=','3')
            ->get();

        $user = array(
            'users'=>$users1,
            'viewmeter' => $viewmeter
        );

        //dd($user);
        return View::make('dashboard.dashboard', compact('user'));

    }

    public function update(Request $request)
    {

        try{
                //dd($request->all());
                if($request->total == 0){
                    Session::flash('message', 'Cannot bill to farmer. Since there is nothing to bill!');
                    return redirect('/dashboard'); 
                }
                    
                $bill = new Billings;
                $bill->status = 1;
                $bill->user_id = $request->id;
                $bill->save();

                Session::flash('status', 'Successfully billed to farmer!');
                return redirect('/dashboard'); 
            }
            catch(\Exception $error){
                //dd($error);
               //  Session::flash('message', 'Cannot update empty methods!');
                //return redirect('/survey/method'); 
            }
    }
}
