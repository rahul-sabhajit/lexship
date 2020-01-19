<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppMainController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        $this->middleware('CustomAuth', ['except' => 'logout']);
    }

    public function home()
    {
        return view('home');

    }

    public function showcalulator()
    {
        $access_token = session('secret_token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . 'method',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Bearer $access_token"
            ),
        ));
        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        $array = json_decode($response, true);
        if ($array['message'] == "success") {

            return view('calculator')->with('method', $array['Method']);
        } else {
            echo "method not mound";
        }

    }

    public function calculate(Request $request)
    {

        //echo "hi";
        $access_token = session('secret_token');
        $secret_user_id = session('secret_user_id');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . 'method',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Bearer $access_token"
            ),
        ));
        $responseL = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        $arrayL = json_decode($responseL, true);

        /*$postD['number'] = $request->number;
        $postD['methodType'] = $request->methodType;
        $postD['user_id'] = $secret_user_id;*/
        /*$postData = json_encode($postD);*/
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . 'calculateLcm',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('number' => $request->number,'methodType' => $request->methodType,'user_id' => $secret_user_id),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Bearer $access_token"
            ),
        ));
        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        $array = json_decode($response, true);
        //echo json_encode($array);exit;
        if ($array['message'] == "success") {

            return view('calculator')->with('method', $arrayL['Method'])->with('result', $array)->with('selectedmethod', $request->methodType)->with('given_input', $request->number);
        } else {
            return view('calculator')->with('method', $arrayL['Method'])->with('message', 'Given Input Format Not Supported');
        }

    }

    public function usershow(Request $request){
        //$page =0;
        $page = ($request->input('page'))-1;
        if($page > -1) {
            $curr_start = $page * 15;
        }else{
            $curr_start =0;
        }
        $access_token = session('secret_token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . 'user?page='.$page,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Bearer $access_token"
            ),
        ));
        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        $array = json_decode($response, true);


            return view('userlist')->with('data', $array)->with('pagestart', $curr_start);

    }

    public function lcmcalculated(Request $request){
        $page = ($request->input('page'))-1;
        if($page > -1) {
            $curr_start = $page * 15;
        }else{
            $curr_start =0;
        }
        //echo $page;exit;
        $access_token = session('secret_token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . 'lcmhistory?page='.$page,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Bearer $access_token"
            ),
        ));
        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        $array = json_decode($response, true);
        //echo json_encode($array);exit;
        return view('lcmhistory')->with('data', $array)->with('pagestart', $curr_start);

    }
}
