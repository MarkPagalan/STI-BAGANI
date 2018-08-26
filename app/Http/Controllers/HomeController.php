<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Billings;
use Auth;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;    
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        //$users1 = DB::table('roles')
        //    ->join('roleusers', 'roles.id', '=', 'roleusers.role_id')
        //    ->join('users', 'roleusers.user_id', '=', 'users.id')
       //     ->where('roles.id','=','2')

        $users1 = DB::table('users')

            ->where('users.id','=',Auth::user()->id)
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
        return View::make('home', compact('user'));
    }


    public function update(Request $request)
    {

        try{
                //dd($request->all());
                if($request->total == 0){
                 //   Session::flash('message', 'Cannot bill to farmer. Since there is nothing to bill!');
                 //   return redirect('/dashboard'); 
                }

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api-uat.unionbankph.com/ubp/uat/online/v1/payments/single",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => "{\"senderPaymentId\":\"00001\",\"paymentRequestDate\":\"2017-10-10T12:11:50Z\",\"biller\":{\"id\":\"0202\",\"name\":\"\"},\"amount\":{\"currency\":\"PHP\",\"value\":\"100\"},\"remarks\":\"Payment remarks\",\"particulars\":\"Payment particulars\",\"references\":[{\"index\":1,\"name\":\"Payor\",\"value\":\"Juan Dela Cruz\"},{\"index\":2,\"name\":\"InvoiceNo\",\"value\":\"12345\"}]}",
                  CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: Bearer REPLACE_BEARER_TOKEN",
                    "content-type: application/json",
                    "x-ibm-client-id: REPLACE_THIS_KEY",
                    "x-ibm-client-secret: REPLACE_THIS_KEY",
                    "x-partner-id: REPLACE_THIS_VALUE"
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                  echo "cURL Error #:" . $err;
                } else {
                  echo $response;
                }
                    
                //$bill = new Billings;
                //$bill->status = 1;
                //$bill->user_id = $request->id;
                //$bill->save();

                //Session::flash('status', 'Successfully billed to farmer!');
                //return redirect('/dashboard'); 
            }
            catch(\Exception $error){
                //dd($error);
               //  Session::flash('message', 'Cannot update empty methods!');
                //return redirect('/survey/method'); 
            }
    }
}
