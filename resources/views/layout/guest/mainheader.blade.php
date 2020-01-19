<div id="home" class="top-header">
    <div class="container">
        <div class="logo">
            <h1><a href="#">LCM</a></h1>
        </div>
        <div class="top-menu">
            <span class="menu"><img src="images/nav-icon.png" alt=""/></span>
            <ul style="">
                <li><a class="" href="#"></a></li>
                <li><a class="" href="#"></a></li>
                <li><a class="" href="{{url('login')}}">Login</a></li>
                <li><a class="" href="{{url('register')}}">Registration</a></li>
                <li><a class="" href="#"></a></li>
                <li><a class="" href="#"></a></li>

            </ul>
            <!-- script-for-menu -->
            <script>
                $("span.menu").click(function(){
                    $(".top-menu ul").slideToggle("slow" , function(){
                    });
                });
            </script>
            <!-- script-for-menu -->
        </div>
    </div>
</div>
