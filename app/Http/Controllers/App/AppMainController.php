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

    public function package()
    {
        $access_token = session('secret_token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . 'package',
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
          //  echo json_encode($array['package'][0]['vendor_json']);exit;

            return view('package')->with('package', $array['package']);
        } else {
            echo "method not mound";
        }

    }

    public function package_single($awb_number)
    {
        $access_token = session('secret_token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . 'package_details',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('awb_number' => $awb_number),
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
            //  echo json_encode($array['package'][0]['vendor_json']);exit;

            return view('packageStatus')->with('package', $array['package']);
        } else {
            echo "method not mound";
        }

    }
    public function updateStatus(Request $request)
    {
        $access_token = session('secret_token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . 'package_status_update',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('awb_number' => $request->awb_number, 'status' => $request->status),
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
            //  echo json_encode($array['package'][0]['vendor_json']);exit;

            return view('packageStatus')->with('package', $array['package']);
        } else {
            echo "method not mound";
        }

    }

    public function export()
    {
        $access_token = session('secret_token');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . 'reportData',
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
        if ($array['message'] == "success") {

            return view('export')->with('report', $array['report']);
        } else {
            echo "method not mound";
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
