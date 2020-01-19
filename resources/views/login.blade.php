@extends('layout.applogin')
@section('main-content')
    <div class="header">
        <div class="container">
            <div class="banner-info">
                <div class="col-md-8 col-md-offset-2">
                <h2 style="text-align: center">Login</h2>
                    <br/>
                <div class="row">
                <form class="form-horizontal" method="post" action="{{url('/loginData')}}" enctype=multipart/form-data>
                <div class="col-md-12" >
                <div class="form-group">
                {!! csrf_field() !!}

                <strong style="color: #ffffff">{{ session()->get( 'message' ) }}</strong>
                <input class="form-control" type="email" id="email" name="email" placeholder="Enter your Email" required>
                </div>
                </div>
                <div class="col-md-12" >
                <div class="form-group">
                <input class="form-control" type="password" id="password" name="password" placeholder="Enter your Password" required>
                </div>
                </div>
                <div class="col-md-12" >
                <div class="form-group" align="center">
                 {{--<input class="btn btn-primary" type="submit" id="submit" name="submit" value="Login" >--}}
                    <button class="btn btn-primary" type="submit" id="submit" name="submit" >Login</button>
                 </div>
                </div>
                </form>
                </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>


@endsection
