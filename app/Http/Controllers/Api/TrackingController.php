<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Tracking;
use Illuminate\Http\Request;
use App\User;
use App\TrackingStatus;

class TrackingController extends Controller
{
    public function package_details(Request $request)
    {

        $package = Tracking::orderBy('id', 'DESC')->get();
        return response(['code' => "200",'message' => 'success','package' => $package]);
    }

    public function package_single(Request $request)
    {

        $package = Tracking::where('awb_number', $request->awb_number)->orderBy('id', 'DESC')->get();
        return response(['code' => "200",'message' => 'success','package' => $package]);
    }

    public function updateStatus(Request $request)
    {
        $awb_number = $request->awb_number;
        $status_code = $request->status;
        if($status_code == "OC"){
            $statusDecreption = "Shipment information sent to FedEx";
        }elseif ($status_code == "PU"){
            $statusDecreption ="Picked Up";
        }elseif ($status_code == "IT"){
            $statusDecreption ="In Transit";
        }elseif ($status_code == "DL"){
            $statusDecreption ="Delivered";
        }else{
            $statusDecreption ='';
        }
        //echo $status_code;exit;

        $package = Tracking::where('awb_number', $request->awb_number)->first();
        $array = json_decode($package['vendor_json'],true);
        if(isset($array['TrackDetails']['StatusCode'])) {
             $array['TrackDetails']['StatusCode'] =$status_code;
             $array['TrackDetails']['StatusDescription'] =$statusDecreption;
             $arrsize = $array['TrackDetails']['Events'];
            //echo $array['TrackDetails']['Events'][0]['Timestamp'];exit;
            switch ($status_code) {
                case "OC":
                    for($i=0;$i<sizeof($arrsize); $i++) {
                        if($array['TrackDetails']['Events'][$i]['EventType'] == "OC"){
                            $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                            $array['TrackDetails']['Events'][$i]['EventDescription'] = $statusDecreption;

                        }else{
                            $array['TrackDetails']['Events'][$i]['Timestamp'] = '';
                            $array['TrackDetails']['Events'][$i]['EventDescription'] = '';

                        }
                    }

                    break;
                case "PU":
                    for($i=0;$i<sizeof($arrsize); $i++){
                        if($array['TrackDetails']['Events'][$i]['EventType'] == "PU") {
                            $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                            $array['TrackDetails']['Events'][$i]['EventDescription'] = $statusDecreption;

                        }elseif($array['TrackDetails']['Events'][$i]['EventType'] == "OC"){
                            if(isset($array['TrackDetails']['Events'][$i]['EventDescription'])) {
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = $array['TrackDetails']['Events'][$i]['Timestamp'];
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = $array['TrackDetails']['Events'][$i]['EventDescription'];

                            }else{
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = "Shipment information sent to FedEx";
                            }


                        }else{
                            $array['TrackDetails']['Events'][$i]['Timestamp'] = '';
                            $array['TrackDetails']['Events'][$i]['EventDescription'] = '';
                        }
                    }

                    break;
                case "IT":
                    for($i=0;$i<sizeof($arrsize); $i++){
                        if($array['TrackDetails']['Events'][$i]['EventType'] == "IT") {
                            $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                            $array['TrackDetails']['Events'][$i]['EventDescription'] = $statusDecreption;

                        }elseif($array['TrackDetails']['Events'][$i]['EventType'] == "PU"){
                            if(isset($array['TrackDetails']['Events'][$i]['EventDescription'])) {
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = $array['TrackDetails']['Events'][$i]['Timestamp'];
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = $array['TrackDetails']['Events'][$i]['EventDescription'];

                            }else{
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = "Picked Up";

                            }

                        }elseif($array['TrackDetails']['Events'][$i]['EventType'] == "OC"){
                            if(isset($array['TrackDetails']['Events'][$i]['EventDescription'])) {
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = $array['TrackDetails']['Events'][$i]['Timestamp'];
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = $array['TrackDetails']['Events'][$i]['EventDescription'];

                            }else{
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = "Shipment information sent to FedEx";

                            }
                        }elseif($array['TrackDetails']['Events'][$i]['EventType'] == "DL"){
                            $array['TrackDetails']['Events'][$i]['Timestamp'] = '';
                            $array['TrackDetails']['Events'][$i]['EventDescription'] = '';
                        }
                    }

                    break;
                case "DL":

                    for($i=0;$i<sizeof($arrsize); $i++){
                        //echo json_encode($array['TrackDetails']['Events'][$i]['EventType']);exit;
                        if($array['TrackDetails']['Events'][$i]['EventType'] == "DL") {

                            $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                            $array['TrackDetails']['Events'][$i]['EventType'] = $status_code;
                            $array['TrackDetails']['Events'][$i]['EventDescription'] = $statusDecreption;


                          //  echo json_encode($store_dl5);exit;
                        }elseif($array['TrackDetails']['Events'][$i]['EventType'] == "IT"){
                            if(isset($array['TrackDetails']['Events'][$i]['EventDescription'])) {
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = $array['TrackDetails']['Events'][$i]['Timestamp'];
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = $array['TrackDetails']['Events'][$i]['EventDescription'];


                            }else{
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = "In Transit";

                            }

                        }elseif($array['TrackDetails']['Events'][$i]['EventType'] == "PU"){
                            if(isset($array['TrackDetails']['Events'][$i]['EventDescription'])) {
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = $array['TrackDetails']['Events'][$i]['Timestamp'];
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = $array['TrackDetails']['Events'][$i]['EventDescription'];

                            }else{
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = "Picked Up";

                            }
                        }elseif($array['TrackDetails']['Events'][$i]['EventType'] == "OC"){
                            if(isset($array['TrackDetails']['Events'][$i]['EventDescription'])) {
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = $array['TrackDetails']['Events'][$i]['Timestamp'];
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = $array['TrackDetails']['Events'][$i]['EventDescription'];

                            }else{
                                $array['TrackDetails']['Events'][$i]['Timestamp'] = date("Y-m-d h:i:s");
                                $array['TrackDetails']['Events'][$i]['EventDescription'] = "Shipment information sent to FedEx";

                            }
                        }
                    }

                    break;
                default:

            }
        }
        $data = json_encode($array);
        Tracking::where('awb_number' , '=', $awb_number)->update(['vendor_json' => $data]);
        TrackingStatus::where('awb_number' , '=', $awb_number)->delete();
        $packagedata = Tracking::where('awb_number' , '=', $awb_number)->get();
        foreach ($packagedata as $key =>$value){
            $awb_number = $value->awb_number;
            $array1='['.$value['vendor_json'].']';
            foreach (json_decode($array1) as $key1 =>$value_data) {
                $eventtype = json_encode($value_data->TrackDetails->Events);
                //echo json_encode($value_data->TrackDetails->Events);exit;
                foreach (json_decode($eventtype)  as $key2 =>$value_data2) {
                    if($value_data2->EventDescription !='') {
                        $store['status_name'] = $value_data2->EventDescription;
                        $store['created'] = date('Y-m-d H:i:s', strtotime($value_data2->Timestamp));;
                        $store['updated'] = date('Y-m-d H:i:s', strtotime($value_data2->Timestamp));;
                        $store['status_code'] = $value_data2->EventType;
                        $store['awb_number'] = $awb_number;
                        $store['event_date'] = date('Y-m-d H:i:s', strtotime($value_data2->Timestamp));
                        TrackingStatus::create($store);
                    }
                }
            }
        }

        $package = Tracking::where('awb_number', $awb_number)->orderBy('id', 'DESC')->get();
        return response(['code' => "200",'message' => 'success','package' => $package]);
    }

    public function reportData(Request $request)
    {
        $package = Tracking::get();
        $report = [];
        foreach ($package as $key =>$value){
            $package = Tracking::where('awb_number', $value->awb_number)->first();
            $array = json_decode($package['vendor_json'],true);
            $tracking_number = $array['TrackDetails']['TrackingNumber'];
         $package_tracking = TrackingStatus::where('awb_number', $value->awb_number)->where('status_code', "DL")->orderBy('updated', 'DESC')->first();;
         if($package_tracking){
             $package_tracking_status_IT = TrackingStatus::where('awb_number', $value->awb_number)->where('status_code', "IT")->orderBy('updated', 'DESC')->first();
             $package_tracking_status_PU = TrackingStatus::where('awb_number', $value->awb_number)->where('status_code', "PU")->orderBy('updated', 'DESC')->first();
             $package_tracking_status_OC = TrackingStatus::where('awb_number', $value->awb_number)->where('status_code', "OC")->orderBy('updated', 'DESC')->first();
            // echo json_encode($package_tracking_status_PU);exit;
             if(isset($tracking_number))
             $store['tracking'] = $tracking_number;
             if(isset($value->awb_number))
             $store['awb_number'] = $value->awb_number;
             if(isset($package_tracking_status_OC->status_name))
             $store['oc'] = $package_tracking_status_OC->status_name;
             if(isset($package_tracking_status_OC->updated))
             $store['oc_datetime'] = $package_tracking_status_OC->updated;
             if(isset($package_tracking_status_PU->status_name))
             $store['pu'] = $package_tracking_status_PU->status_name;
             if(isset($package_tracking_status_PU->updated))
             $store['pu_datetime'] = $package_tracking_status_PU->updated;
             if(isset($package_tracking_status_IT->status_name))
             $store['it'] = $package_tracking_status_IT->status_name;
             if(isset($package_tracking_status_IT->updated))
             $store['it_datetime'] = $package_tracking_status_IT->updated;
             if(isset($package_tracking->status_name))
             $store['dl'] = $package_tracking->status_name;
             if(isset($package_tracking->updated))
             $store['dl_datetime'] = $package_tracking->updated;
             array_push($report,$store);
         }

        }
        return response(['code' => "200",'message' => 'success','report' => $report]);
    }


    public function updateTrackingStatusTable(Request $request)
    {

        $package = Tracking::get();
        //echo json_encode($package);exit;
        foreach ($package as $key =>$value){
            $awb_number = $value->awb_number;
            $array1='['.$value['vendor_json'].']';

            foreach (json_decode($array1) as $key1 =>$value_data) {
                $eventtype = json_encode($value_data->TrackDetails->Events);
                foreach (json_decode($eventtype)  as $key2 =>$value_data2) {
                    //echo json_encode($value_data2->Timestamp);
                    $store['status_name'] = $value_data2->EventDescription;
                    $store['created'] = date('Y-m-d H:i:s', strtotime($value_data2->Timestamp));;
                    $store['updated'] = date('Y-m-d H:i:s', strtotime($value_data2->Timestamp));;
                    $store['status_code'] = $value_data2->EventType;
                    $store['awb_number'] = $awb_number;
                    $store['event_date'] = date('Y-m-d H:i:s', strtotime($value_data2->Timestamp));
                    TrackingStatus::create($store);
                }
            }
        }
       // echo json_encode($array);exit;
        return response(['code' => "200",'message' => 'success','package' => $package]);
    }

    public function userlist(Request $request)
    {
        $user = $request->user()->orderBy('users.id', 'DESC')->paginate(15);
        return response(['code' => "200",'message' => 'success','userdata' => $user]);
    }

}
