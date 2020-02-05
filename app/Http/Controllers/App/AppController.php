<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\LocalUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AppController extends Controller
{
    public function __construct()
    {
        if (Auth::user()) {
            return redirect('/home');
        }
    }

    public function login(Request $request)
    {
        return view('login');
    }
    public function logout(Request $request)
    {
            Auth::logout();
            Session::flush();
            return redirect('/');

    }

    public function loginPost(Request $request)
    {


        $postD['email'] = $request->email;
        $postD['password'] = $request->password;
        $postData = json_encode($postD);
        //echo json_encode($postData);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL').'login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  $postData,
            CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
            CURLOPT_SSL_VERIFYHOST=>false
        ));
        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        $array = json_decode($response, true);
        //echo json_encode($array);exit;
        if($array['message'] == "success") {
            //$user_id = $array['user']['id'];
            //$request->session()->put('secret_token', $array['access_Token']);

            if(Auth::guard('CustomAuth')->attempt(['email' =>$request->email , 'password'=>$request->password])){
                $request->session()->put('secret_token', $array['access_Token']);
                $request->session()->put('secret_user_id', $array['user']['id']);
                return redirect()->intended('home');
            }else{
                $message= "unauthenticated";
                return redirect('/')->with( ['message' => $message] );
            }

        }else{
            $message = $array['message'];
            return redirect('/')->with( ['message' => $message] );
        }
    }
    public function register(Request $request)
    {
        return view('register');
    }


    public function registerPost(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL').'register',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  array('name' => $request->name,'email' => $request->email,'password' => $request->password,'password_confirmation' => $request->password_confirmation),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json"
            ),
        ));
        $response = curl_exec($curl);
        //echo json_encode($response);exit;

        $err = curl_error($curl);
        curl_close($curl);
        $array = json_decode($response, true);
        //echo json_encode($array['access_Token']);exit;
        if($array['message'] == "success") {
            $localData['email'] = $request->email;
            $localData['password'] = bcrypt($request->password);
            $localData['token'] = $array['access_Token'];
            $user = LocalUser::create($localData);
            $postR['email'] = $request->email;
            $postR['password'] = $request->password;
            $postLData = json_encode($postR);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => env('API_URL').'login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postLData,
                CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
                CURLOPT_SSL_VERIFYHOST=>false
            ));
            $responseL = curl_exec($curl);

            $err = curl_error($curl);
            curl_close($curl);
            $arrayL = json_decode($responseL, true);
            if($arrayL['message'] == "success") {

                //return redirect('/home')->with( ['message' => $array['message']] );
                if(Auth::guard('CustomAuth')->attempt(['email' =>$request->email , 'password'=>$request->password])){
                    $request->session()->put('secret_token', $arrayL['access_Token']);
                    $request->session()->put('secret_user_id', $arrayL['user']['id']);
                    return redirect()->intended('home');
                }else{
                    $message= "Registration Successfull";
                    return redirect('/')->with( ['message' => $message] );
                }
            }else{
                $message = $array['message'];
                return redirect('/register')->with( ['message' => $message] );
            }
        }else{
            $message = $array['errors']['email'][0];
            //echo $message;exit;
            return redirect('/register')->with( ['message' => $message] );
        }
    }
}
