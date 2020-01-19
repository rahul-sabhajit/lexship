<!DOCTYPE HTML>
<html lang="en">
@section('htmlheader')
@include('layout.htmlheader')
@show

<body onload="myFunction()">
<div id="loader" style="background-color: #2e6da4;"></div>
<div style="opticity:0.5;" id="maindv" class="animate-bottom">

@include('layout.mainheader')
@yield('main-content')
@section('script')
@include('layout.script')
@show
@include('layout.footer')
</div>

</body>

