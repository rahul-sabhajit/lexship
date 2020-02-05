@extends('layout.app')
@section('main-content')
    <br/>
    <div id="home1" style="margin-top: 1%;margin-bottom: 25%;">
        <div class="container">
            <div class="col-md-12 col-md-offset-0">
                <div class="col-md-12 center-block">
                    <div class="box box-primary ">
                        <div class="box-header with-border " align="center">
                            <h2 class="box-title">Package Status </h2>
                        </div>
                        <div class="box-body">
                            <table id="data_table" width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped table-condensed "  >
                                <thead style="background-color: #2e6da4; color: #FFF;">
                                <tr>
                                    <th width="27">#</th>
                                    <th width="40">Order Id</th>
                                    <th width="40">AWB Number</th>
                                    <th width="40">Current Status</th>
                                    <th width="40">Created At</th>
                                    <th width="40">Updated At</th>
                                    <th width="40">Change Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=0;
                                foreach ($package as $key => $_data) {
                                $array1='['.$_data['vendor_json'].']';
                                ?>

                                <tr>
                                    <td><div align="center"><?php echo ++$i; ?></div></td>
                                    <td><div align="left"><?php echo $_data['order_id']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['awb_number']; ?></div></td>
                                    <td><div align="left">
                                            <?php
                                            foreach (json_decode($array1) as $key1 => $jdata){
                                                if(isset($jdata->TrackDetails->StatusCode)){
                                                echo $jdata->TrackDetails->StatusCode.' - '.$jdata->TrackDetails->StatusDescription;
                                                }/*else{
                                                    if(isset($jdata->TrackPackagesResponse->packageList[0]->scanEventList[0]->statusCD)){
                                                    echo $jdata->TrackPackagesResponse->packageList[0]->scanEventList[0]->statusCD.' - '.$jdata->TrackPackagesResponse->packageList[0]->scanEventList[0]->status;
                                                    }*/

                                                }

                                             ?></div></td>
                                    <td><div align="left"><?php echo date('d-m-Y H:i:s', strtotime($_data['created_at'])); ?></div>
                                    </td>
                                    <td><div align="left"><?php echo date('d-m-Y H:i:s', strtotime($_data['updated_at'])); ?></div>
                                    </td>
                                    <td><div align="left"><a href="{{url('package_single/'.$_data['awb_number'])}}" class="btn btn-danger">Update</a></div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>


                        </div>
                    </div></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#data_table').DataTable();
        } );
    </script>
@endsection
