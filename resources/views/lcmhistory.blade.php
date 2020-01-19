@extends('layout.app')
@section('main-content')
    <br/>
    <div id="home1" style="margin-top: 5%;margin-bottom: 25%;">
        <div class="container">
            <div class="col-md-12 col-md-offset-0">
                <div class="col-md-12 center-block">
                    <div class="box box-primary ">
                        <div class="box-header with-border ">
                            <h2 class="box-title">LCM List History</h2>
                        </div>
                        <div class="box-body">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped table-condensed "  >
                                <thead style="background-color: #2e6da4; color: #FFF;">
                                <tr>
                                    <th width="27">#</th>
                                    <th width="40">User Email</th>
                                    <th width="40">Input</th>
                                    <th width="40">Used Method</th>
                                    <th width="40">Calculated Lcm</th>
                                    <th width="40">Execution Time</th>
                                    <th width="40">Best Method</th>
                                    <th width="40">Best Execution Time</th>
                                    <th width="40">Created Time</th>
                                </tr>
                                </thead>
                                <?php
                                //echo $pagestart;
                                $i=$pagestart;
                                //echo json_encode($data['data'] );

                                foreach ($data['Lcmdata']['data'] as $key => $_data) {
                                ?>
                                <tbody>
                                <tr>
                                    <td><div align="center"><?php echo ++$i; ?></div></td>
                                    <td><div align="left"><?php echo $_data['email']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['number']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['lcmtype']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['calculatedlcm']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['executiontime']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['bestmethod']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['bestexecution']; ?></div></td>
                                    <td><div align="left"><?php echo date('d-m-Y H:i:s', strtotime($_data['created_at'])); ?></div>
                                    </td>
                                </tr>
                                </tbody>
                                <?php } ?>
                            </table>

                            <div class="pagination pull-right">
                                <div class="pagination">
                                    <?php
                                    $prev =1;
                                    $next = $data['Lcmdata']['last_page'];
                                    if($data['Lcmdata']['current_page']-1 > 1) { $prev = $data['Lcmdata']['current_page']-1;}?>
                                    <a href="{{url('/lcmhistory'.'?'.'page='.$prev)}}">&laquo;</a>
                                    <?php
                                    $last = $data['Lcmdata']['last_page'];
                                    for ($start =1; $start <= $last; $start++ ){?>
                                    <a href="{{url('/lcmhistory'.'?'.'page='.$start)}}"><?php echo $start;?></a>
                                    <?php } ?>
                                    <?php if($data['Lcmdata']['current_page']+1 <= $last) { $next = $data['Lcmdata']['current_page']+1;}?>
                                    <a  href="{{url('/lcmhistory'.'?'.'page='.$next)}}">&raquo;</a>
                                </div>

                            </div>

                        </div>
                    </div></div>
            </div>
        </div>
    </div>


@endsection
