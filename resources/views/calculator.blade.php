@extends('layout.app')
@section('main-content')
    <div class="header">
        <div class="container">
            <div class="banner-info">
                <div class="col-md-8 col-md-offset-2">
                    <h2 style="text-align: center">Find the LCM</h2>
                    <br/>
                    <div class="row">
                        <?php if (!isset($selectedmethod)){ $selectedmethod = 0;}

                        ?>
                        <form class="form-horizontal" method="post" action="{{url('/lcm')}}" enctype=multipart/form-data>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    {!! csrf_field() !!}

                                    <strong style="color: #ffffff">{{ session()->get( 'message' ) }}</strong>
                                    <label style="text-align: center; color: #ffffff">enter two or more numbers</label>
                                    <input class="form-control" type="text" id="number" name="number" value="<?php if(isset($given_input)){echo $given_input;} ?>" placeholder="eg. 25 45 36" required>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label style="text-align: center; color: #ffffff">Choose Method</label>
                                    <select class="form-control select2 select2-hidden-accessible" name="methodType" id="methodType" area-hidden="true" required>
                                    <option>Select Method</option>
                                        <?php foreach ($method as $key => $value){?>
                                        <option value ="{{ $value['id'] }}" <?php if($selectedmethod == $value['id']){ ?> selected = "selected" <?php } ?>>{{ $value['methodName'] }}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group" align="center">
                                    <input class="btn btn-primary" type="submit" id="submit" name="submit" value="Get" >
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <div class="clearfix"></div>



        </div>

        <div class="col-md-12 col-md-offset-0 table-responsive" style="color: #FFF; background-color: #FFF; padding: 35px; border:2px solid dodgerblue; opacity: 0.9 ">
            <?php
            if(isset($result['code'])){ ?>
            <table style="width:100%; color: #FFF; ">
                <tr style="color: darkred; ">
                    <th width="16" style="color: orange">Method Name</th>
                    <th width="16" style="color: orange">Input</th>
                    <th width="16" style="color: orange">LCM</th>
                    <th width="16" style="color: orange">Execution Time</th>
                    <th width="16" style="color: #2e6da4">Best Method</th>
                    <th width="16" style="color: #2e6da4">Best Time</th>
                </tr>
                <tr style="color: black;">
                    <td><?php echo $result['Method'];?></td>
                    <td><?php if(isset($given_input)){echo $given_input;} ?></td>
                    <td>{{$result['LCM']}}</td>
                    <td>{{$result['Execution Time']}}</td>
                    <td><b>{{$result['bestmethod']}}</b></td>
                    <td><b>{{$result['bestexecution']}}</b></td>
                </tr>

            </table>
            <?php }else{ ?>
            <div align="center">
               <strong style="color: darkred;"> <?php if(isset($message)){ echo $message;} ?></strong><br/>
            <strong style="color: black; text-align: center">Enter input and select method to calculate LCM (Restriction: Enter comma separated or space separated value)</strong>
            </div>
            <?php } ?>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#methodType').select2();
        });
    </script>
@endsection
