@extends('layout.app')
@section('main-content')
    <br/>
    <div id="home1" style="margin-top: 5%;margin-bottom: 25%;">
        <div class="container">
    <div class="col-md-12 col-md-offset-0">
        <div class="col-md-12 center-block">
            <div class="box box-primary ">
                <div class="box-header with-border ">
                    <h2 class="box-title">User List</h2>
                </div>
                <div class="box-body">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped table-condensed "  >
                        <thead style="background-color: #2e6da4; color: #FFF;">
                        <tr>
                            <th width="27">#</th>
                            <th width="40">User Email</th>
                            <th width="40">User Name</th>
                            <th width="40">Created Date</th>
                        </tr>
                        </thead>
                        <?php
                        $i=$pagestart;

                        foreach ($data['userdata']['data'] as $key => $_data) {
                        ?>
                        <tbody>
                        <tr>
                            <td><div align="center"><?php echo ++$i; ?></div></td>
                            <td><div align="left"><?php echo $_data['name']; ?></div></td>
                            <td><div align="left"><?php echo $_data['email']; ?></div></td>
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
                            $next = $data['userdata']['last_page'];
                            if($data['userdata']['current_page']-1 > 1) { $prev = $data['userdata']['current_page']-1;}?>
                            <a href="{{url('/userlist'.'?'.'page='.$prev)}}">&laquo;</a>
                            <?php
                            $last = $data['userdata']['last_page'];
                            for ($start =1; $start <= $last; $start++ ){?>
                            <a href="{{url('/userlist'.'?'.'page='.$start)}}"><?php echo $start;?></a>
                            <?php } ?>
                            <?php if($data['userdata']['current_page']+1 <= $last) { $next = $data['userdata']['current_page']+1;}?>
                            <a  href="{{url('/userlist'.'?'.'page='.$next)}}">&raquo;</a>
                        </div>

                    </div>

                </div>
            </div></div>
    </div>
        </div>
    </div>


@endsection
