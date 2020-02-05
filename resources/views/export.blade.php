@extends('layout.guest.export')
@section('main-content')
    <br/>
    <div id="home1" style="margin-top: 1%;margin-bottom: 25%;">
        <div class="container">
            <div class="col-md-12 col-md-offset-0">
                <div class="col-md-12 center-block">
                    <div class="box box-primary ">
                        <div class="box-header with-border " align="center">
                            <h2 class="box-title">Package Status - DL</h2>
                        </div>
                        <div class="box-body">
                            <table id="data_tableexport" width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped table-condensed "  >
                                <thead style="background-color: #2e6da4; color: #FFF;">
                                <tr>
                                    <th width="27">Sr No</th>
                                    <th width="40">AWB</th>
                                    <th width="40">Tracking Number</th>
                                    <th width="40">OC</th>
                                    <th width="40">Date&Time</th>
                                    <th width="40">PU</th>
                                    <th width="40">Date&Time</th>
                                    <th width="40">IT</th>
                                    <th width="40">Date&Time</th>
                                    <th width="40">DL</th>
                                    <th width="40">Date&Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=0;
                                foreach ($report as $key => $_data) {

                                ?>

                                <tr>
                                    <td><div align="center"><?php echo ++$i; ?></div></td>
                                    <td><div align="left"><?php echo $_data['awb_number']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['tracking']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['oc']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['oc_datetime']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['pu']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['pu_datetime']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['it']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['it_datetime']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['dl']; ?></div></td>
                                    <td><div align="left"><?php echo $_data['dl_datetime']; ?></div></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>


                        </div>
                    </div></div>
            </div>
        </div>
    </div>

@endsection
