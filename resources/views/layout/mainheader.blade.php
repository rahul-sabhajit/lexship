<div id="home" class="top-header">
    <div class="container">
        <div class="logo">
            <h1><a href="#">LCM</a></h1>
        </div>
        <div class="top-menu">
            <span class="menu"><img src="images/nav-icon.png" alt=""/></span>
            <ul>

                <li><a class="" id="lcm" name="lcm" href="{{ url('/lcm') }}">Calculate LCM</a></li>
                <li><a class="" href="#"></a></li>
                <li><a class="" id="userlist" name="userlist" href="{{ url('/userlist?page=1') }}">Users</a></li>
                <li><a class="" id="lcmhistory" name="lcmhistory" href="{{url('/lcmhistory?page=1')}}">LCM History</a></li>
                <li><a class="" href="#"></a></li>
                <li><a class="" id="logout" name="logout" href="{{url('/logout')}}">Logout</a></li>

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
