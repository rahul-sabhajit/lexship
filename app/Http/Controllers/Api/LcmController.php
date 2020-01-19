<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lcmdata;
use App\LcmMethod;
use Illuminate\Http\Request;
use App\User;

class LcmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function algorithm(Request $request){
        $algorithm = LcmMethod::all();
        return response(['code' => "200",'message' => 'success','Method' => $algorithm]);

    }
    public function multiexplode ($delimiters, $string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $array = explode($delimiters[0], $ready);
        $array = array_map('trim', $array);
        return  $array;
    }
    public function computelcm(Request $request)
    {
        $numberArray = $request->number;
        $method = $request->methodType;
        $user_id = $request->user_id;

        $arr = $this->multiexplode(array(',', ' '), $numberArray);

        //$arr =  (explode(array(",",".","|"," "), $numberArray));

        //$arr = array(2, 7, 3, 9, 4 );
        $n = sizeof($arr);
        $best = $this->BestTime($arr, $n);


        switch ($method) {
            case 1:
                // Starting clock time in seconds
                $start_time = microtime(true);
                $lcmresult = $this->ListingMultiples($arr, $n);
                // End clock time in seconds
                $end_time = microtime(true);
                // Calculate script execution time
                $execution_time = round(($end_time - $start_time)*1000,4)." ms";

                $storeLcm['user_id'] = $user_id;
                $storeLcm['number'] = $numberArray;
                $storeLcm['lcmtype'] = 'Listing Multiples';
                $storeLcm['calculatedlcm'] = $lcmresult;
                $storeLcm['executiontime'] = $execution_time;
                $storeLcm['bestmethod'] = $best['bestmethod'];
                $storeLcm['bestexecution'] = $best['besttime'];
                Lcmdata::create($storeLcm);

                return response(['code' => 200, 'message' => "success", 'Method' => "Listing Multiples",'Input' => $arr,'LCM' => $lcmresult,'Execution Time' => $execution_time,'bestmethod' => $best['bestmethod'],'bestexecution' =>  $best['besttime']]);
                break;
            case 2:
                // Starting clock time in seconds
                $start_time = microtime(true);
                $lcmresult = $this->FactorLCM($arr, $n);
                // End clock time in seconds
                $end_time = microtime(true);
                // Calculate script execution time
                $execution_time = round(($end_time - $start_time)*1000,4)." ms";

                $storeLcm['user_id'] = $user_id;
                $storeLcm['number'] = $numberArray;
                $storeLcm['lcmtype'] = 'Prime Factorization';
                $storeLcm['calculatedlcm'] = $lcmresult;
                $storeLcm['executiontime'] = $execution_time;
                $storeLcm['bestmethod'] = $best['bestmethod'];
                $storeLcm['bestexecution'] = $best['besttime'];
                Lcmdata::create($storeLcm);

                return response(['code' => 200, 'message' => "success", 'Method' => "Prime Factorization",'Input' => $arr,'LCM' => $lcmresult,'Execution Time' => $execution_time ,'bestmethod' => $best['bestmethod'],'bestexecution' =>  $best['besttime']]);
        break;
            case 3:
                // Starting clock time in seconds
                $start_time = microtime(true);
                $lcmresult = $this->CakeLadder($arr, $n);
                // End clock time in seconds
                $end_time = microtime(true);
                // Calculate script execution time
                $execution_time = round(($end_time - $start_time)*1000,4)." ms";
                $storeLcm['user_id'] = $user_id;
                $storeLcm['number'] = $numberArray;
                $storeLcm['lcmtype'] = 'Greatest Common Factor GCF';
                $storeLcm['calculatedlcm'] = $lcmresult;
                $storeLcm['executiontime'] = $execution_time;
                $storeLcm['bestmethod'] = $best['bestmethod'];
                $storeLcm['bestexecution'] = $best['besttime'];
                Lcmdata::create($storeLcm);
                return response(['code' => 200, 'message' => "success", 'Method' => "Greatest Common Factor GCF",'Input' => $arr,'LCM' => $lcmresult,'Execution Time' => $execution_time ,'bestmethod' => $best['bestmethod'],'bestexecution' =>  $best['besttime']]);
                break;

            case 4:
                // Starting clock time in seconds
                $start_time = microtime(true);
                $lcmresult = $this->division($arr, $n);
                // End clock time in seconds
                $end_time = microtime(true);
                // Calculate script execution time
                $execution_time = round(($end_time - $start_time)*1000,4)." ms";
                $storeLcm['user_id'] = $user_id;
                $storeLcm['number'] = $numberArray;
                $storeLcm['lcmtype'] = 'Division Method';
                $storeLcm['calculatedlcm'] = $lcmresult;
                $storeLcm['executiontime'] = $execution_time;
                $storeLcm['bestmethod'] = $best['bestmethod'];
                $storeLcm['bestexecution'] = $best['besttime'];
                Lcmdata::create($storeLcm);
                return response(['code' => 200, 'message' => "success", 'Method' => "Division Method",'Input' => $arr,'LCM' => $lcmresult,'Execution Time' => $execution_time,'bestmethod' => $best['bestmethod'],'bestexecution' =>  $best['besttime']]);
                break;

            case 5:
                // Starting clock time in seconds
                $start_time = microtime(true);
                $lcmresult = $this->findlcm($arr, $n);
                // End clock time in seconds
                $end_time = microtime(true);
                // Calculate script execution time
                $execution_time = round(($end_time - $start_time)*1000,4)." ms";
                $storeLcm['user_id'] = $user_id;
                $storeLcm['number'] = $numberArray;
                $storeLcm['lcmtype'] = 'Cake / Ladder Method';
                $storeLcm['calculatedlcm'] = $lcmresult;
                $storeLcm['executiontime'] = $execution_time;
                $storeLcm['bestmethod'] = $best['bestmethod'];
                $storeLcm['bestexecution'] = $best['besttime'];
                Lcmdata::create($storeLcm);
                return response(['code' => 200, 'message' => "success", 'Method' => "Cake / Ladder Method",'Input' => $arr,'LCM' => $lcmresult,'Execution Time' => $execution_time,'bestmethod' => $best['bestmethod'],'bestexecution' =>  $best['besttime']]);
                break;
            default:
                echo "nomethod";
        }
        //return response(json_encode($request->number));

    }
    public function BestTime($arr, $n)
    {
        $start_listing = microtime(true);
        $this->ListingMultiples($arr, $n);
        $end_listing = microtime(true);
        $execution_time_Mlisting = round(($end_listing - $start_listing)*1000,4);

        $start_prime_factor = microtime(true);
        $this->FactorLCM($arr, $n);
        $end_prime_factor = microtime(true);
        $execution_time_prime_factor = round(($end_prime_factor - $start_prime_factor)*1000,4);

        $start_cake = microtime(true);
        $this->CakeLadder($arr, $n);
        $end_cake = microtime(true);
        $execution_time_cake = round(($end_cake - $start_cake)*1000,4);

        $start_division = microtime(true);
        $this->division($arr, $n);
        $end_division = microtime(true);
        $execution_time_division = round(($end_division - $start_division)*1000,4);

        $start_gcf = microtime(true);
        $this->findlcm($arr, $n);
        $end_gcf = microtime(true);
        $execution_time_gcf = round(($end_gcf - $start_gcf)*1000,4);

        $bestarray['Listing Multiples'] = $execution_time_Mlisting;
        $bestarray['Prime Factorization'] = $execution_time_prime_factor;
        $bestarray['Cake/Ladder Method'] = $execution_time_cake;
        $bestarray['Division Method'] = $execution_time_division;
        $bestarray['GCF Method'] = $execution_time_gcf;
        $newarray = $bestarray;
        sort($newarray);
        $output = array();
        foreach ($bestarray as $key =>$value){
            if($value == $newarray[0]){
                $output['bestmethod'] = $key;
                $output['besttime'] = $value." ms" ;
            }
        }

        return $output;
    }
    public function ListingMultiples($arr, $n)
    {

        sort($arr);

        $greatest = $arr[sizeof($arr)-1];

        $isValid = true;
        $counter = 1;
        $value = 0;
        $sec = 0;

        while ($isValid){
            $value = $greatest * $counter;
            for ($i = 0 ; $i < sizeof($arr)-1; $i++){
                if($value % $arr[$i] == 0){
                    $sec ++;
                }
            }
            $counter++;
            if($sec == sizeof($arr)-1){
                $isValid = false;
            }
            $sec = 0;
        }
        return $value;
    }
    public function division($arr, $n)
    {
        $lcm = 1;
        $max= max($arr);
        $prime_array = $this->prime($max);
        $cake=array();

        for($j=0; $j < sizeof($prime_array); $j++){

            $count = 0;
            while ($count != sizeof($arr)) {
                $isfactor = false;
                for ($i = 0; $i < sizeof($arr); $i++) {
                    if ($arr[$i] % $prime_array[$j] == 0) {
                        $arr[$i] = $arr[$i] / $prime_array[$j];
                        $isfactor = true;
                    }
                }

                if ($isfactor) {
                    array_push($cake, $prime_array[$j]);

                } else {
                    $count++;
                }
            }
        }

        for ($k = 0; $k < sizeof($arr); $k++) {
            array_push($cake, $arr[$k]);
        }

        for ($l= 0; $l < sizeof($cake); $l++) {
            $lcm *=$cake[$l];
        }


        return $lcm;
    }
    public function CakeLadder($arr, $n)
    {
        $lcm = 1;
        $max= max($arr);
        $prime_array = $this->prime($max);
        $cake=array();

        for($j=0; $j < sizeof($prime_array); $j++){

            $count = 0;
            while ($count != sizeof($arr)) {
                $isfactor = false;
                for ($i = 0; $i < sizeof($arr); $i++) {
                    if ($arr[$i] % $prime_array[$j] == 0) {
                        $arr[$i] = $arr[$i] / $prime_array[$j];
                        $isfactor = true;
                    }
                }

                if ($isfactor) {
                    array_push($cake, $prime_array[$j]);

                } else {
                    $count++;
                }
            }
        }

        for ($k = 0; $k < sizeof($arr); $k++) {

            $lcm *=$arr[$k];
        }

        for ($l= 0; $l < sizeof($cake); $l++) {
            $lcm *=$cake[$l];
        }


        return $lcm;
    }
    public function prime($max)
    {
        $prime=array();

        for( $j = 2; $j <= $max; $j++ )
        {
            for( $k = 2; $k < $j; $k++ )
            {
                if( $j % $k == 0 )
                {
                    break;
                }

            }
            if( $k == $j )
                array_push($prime, $j);
        }
        return $prime;
    }
    public function FactorLCM($arr, $n)
    {
        // Find the maximum value in arr[]
        $max_num = 0;
        for ($i = 0; $i < $n; $i++)
            if ($max_num < $arr[$i])
                $max_num = $arr[$i];

        // Initialize result
        $res = 1;

        // Find all factors that are present
        // in two or more array elements.
        $x = 2; // Current factor.
        while ($x <= $max_num)
        {
            // To store indexes of all array
            // elements that are divisible by x.
            $indexes = array();
            for ($j = 0; $j < $n; $j++)
                if ($arr[$j] % $x == 0)
                    array_push($indexes, $j);

            // If there are 2 or more array
            // elements that are divisible by x.
            if (count($indexes) >= 2)
            {
                // Reduce all array elements
                // divisible by x.
                for ($j = 0; $j < count($indexes); $j++)
                    $arr[$indexes[$j]] = (int)($arr[$indexes[$j]] / $x);

                $res = $res * $x;
            }
            else
                $x++;
        }

        // Then multiply all reduced
        // array elements
        for ($i = 0; $i < $n; $i++)
            $res = $res * $arr[$i];

        return $res;
    }
    public function gcd($a, $b)
    {
        if ($b == 0)
            return $a;
        return $this->gcd($b, $a % $b);
    }

// Returns LCM of array elements
    function findlcm($arr, $n)
    {

        // Initialize result
        $ans = $arr[0];

        // ans contains LCM of
        // arr[0], ..arr[i]
        // after i'th iteration,
        for ($i = 1; $i < $n; $i++)
            $ans = ((($arr[$i] * $ans)) /
                ($this->gcd($arr[$i], $ans)));

        return $ans;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lcmhistory(Request $request)
    {
        $calculatedLcm = Lcmdata::select('lcmdatas.*', 'users.email')->leftjoin('users', 'lcmdatas.user_id' ,'=', 'users.id' )->orderBy('lcmdatas.id', 'DESC')->paginate(15);;
        return response(['code' => "200",'message' => 'success','Lcmdata' => $calculatedLcm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userlist(Request $request)
    {
        $user = $request->user()->orderBy('users.id', 'DESC')->paginate(15);
        return response(['code' => "200",'message' => 'success','userdata' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
