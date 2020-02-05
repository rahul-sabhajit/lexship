<div id="home" class="top-header">
    <div class="container">
        <div class="top-menu">
            <span class="menu"><img src="images/nav-icon.png" alt=""/></span>
            <ul>
                <li><a class="" id="package" name="package" href="{{ url('/package') }}">Package</a></li>
                <li><a class="" href="#"></a></li>
                <li><a class="" id="export" name="export" href="{{url('/export')}}">Export</a></li>
                <li><a class="" id="userlist" name="userlist" href="{{ url('/userlist?page=1') }}">Users</a></li>
                <li><a class="" href="#"></a></li>
                <li><a class="" id="logout" name="logout" href="{{url('/logout')}}">Logout</a></li>

            </ul>
            <!-- script-for-m enu -->
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
