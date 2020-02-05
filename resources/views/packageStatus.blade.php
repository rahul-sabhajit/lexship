@extends('layout.app')
@section('main-content')
    <br/>
    <style>
        .select2{
            width: 25%;
        }
    </style>
    <div id="home1" style="margin-top: 1%;margin-bottom: 25%;">
        <div class="container">
            <div class="col-md-12 col-md-offset-0">
                <div class="col-md-12 center-block">
                    <div class="box box-primary ">
                        <div class="box-header with-border " align="center">
                            <h2 class="box-title">Package Status</h2>
                            <br/>
                        </div>
                        <div class="box-body">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped table-condensed "  >
                            <thead style="background-color: #2e6da4; color: #FFF;">
                                <tr>
                                    <th width="40">Order Id</th>
                                    <th width="40">AWB Number</th>
                                    <th width="40">Current Status</th>
                                    <th width="40">Created At</th>
                                    <th width="40">Updated At</th>
                                    <th width="40">Select Status</th>
                                    <th width="40">Update</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $status_select = "OC";
                                foreach ($package as $key => $_data) {
                                $array1='['.$_data['vendor_json'].']';
                                foreach (json_decode($array1) as $key1 => $jdata){
                                    if(isset($jdata->TrackDetails->StatusCode)){
                                        $status = $jdata->TrackDetails->StatusCode.' - '.$jdata->TrackDetails->StatusDescription;
                                        $status_select = $jdata->TrackDetails->StatusCode;
                                    }/*else{
                                        if(isset($jdata->TrackPackagesResponse->packageList[0]->scanEventList[0]->statusCD)){
                                            $status = $jdata->TrackPackagesResponse->packageList[0]->scanEventList[0]->statusCD.' - '.$jdata->TrackPackagesResponse->packageList[0]->scanEventList[0]->status;
                                            $status_select = $jdata->TrackPackagesResponse->packageList[0]->scanEventList[0]->statusCD;
                                        }*/
                                   // }
                                }
                                ?>

                                <tr>
                                    <form class="form-horizontal" method="post" action="{{url('/updateStatus')}}" enctype=multipart/form-data>
                                        {!! csrf_field() !!}
                                    <td><div align="left"><?php echo $_data['order_id']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['awb_number']; ?>
                                            <input type="hidden" id="awb_number" name="awb_number" value="<?php echo $_data['awb_number']; ?>">

                                        </div></td>
                                    <td><div align="left"><?php if(isset($status)){echo $status;}?></div></td>
                                    <td><div align="left"><?php echo date('d-m-Y H:i:s', strtotime($_data['created_at'])); ?></div>
                                    </td>
                                    <td><div align="left"><?php echo date('d-m-Y H:i:s', strtotime($_data['updated_at'])); ?></div>
                                    </td>
                                    <td>
                                        <div>
                                            <select class="form-control select2 select2-hidden-accessible" name="status" id="status" area-hidden="true" required>
                                                <option>Select Status</option>
                                                <option value ="DL" <?php if($status_select == "DL"){ ?> selected = "selected" <?php } ?>><?php echo "DL - Delivered";?></option>
                                                <option value ="OC" <?php if($status_select == "OC"){ ?> selected = "selected" <?php } ?>><?php echo "OC - Shipment information sent to FedEx";?></option>
                                                <option value ="PU" <?php if($status_select == "PU"){ ?> selected = "selected" <?php } ?>><?php echo "PU - Picked Up";?></option>
                                                <option value ="IT" <?php if($status_select == "IT"){ ?> selected = "selected" <?php } ?>><?php echo "IT - In Transit";?></option>
                                            </select>

                                        </div>
                                    </td>
                                    <td><div align="left"><button type="submit" name="submit" id="submit" value="Update" class="btn btn-danger">Update</button></div>
                                    </td>
                                    </form>
                                </tr>
                                <?php  } ?>
                                </tbody>
                            </table>
                            <div>
                                <?php
                                if($status_select == "DL"){?><b style="color: green"><?php echo "Shipment information sent to FedEx ---------------- Picked Up ---------------- In Transit ---------------- Delivered";?></b><?php
                                }elseif($status_select == "IT"){?><b style="color: green"><?php echo "Shipment information sent to FedEx ---------------- Picked Up ---------------- In Transit";?></b><?php echo "---------------- Delivered";
                                }elseif($status_select == "PU"){ ?><b style="color: green"><?php echo "Shipment information sent to FedEx ---------------- Picked Up";?></b><?php echo "---------------- In Transit ---------------- Delivered";
                                }elseif($status_select == "OC"){?><b style="color: green"><?php echo "Shipment information sent to FedEx"; ?></b><?php echo "---------------- Picked Up ---------------- In Transit ---------------- Delivered";

                                } ?>
                            </div>


                        </div>
                    </div></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#status').select2();
        });
    </script>
@endsection
