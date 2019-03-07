<body>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="APP_URL" value="{{ env('APP_URL') }}">
<input type="hidden" name="APP_STORAGE" value="{{ env('APP_STORAGE') }}"> 
    @include('inc.analyticstracking')

<header class="top_header container-fluid no-padding">
    <div class="col-sm-2">
        <span class="fa fa-clock-o"></span> <?php echo date("D, M d, Y", time()); ?>        
    </div>
    
    <div class="col-sm-4">
        <span class="fa fa-envelope"></span>  contact@abujaaprtments.com.ng, akalodave@gmail.com
    </div>
    <div class="col-sm-4">
        <span class="fa fa-phone"></span> 07039775298, 08062977023, 08039249293 
    </div>
    <div class="col-sm-2 sh">
        <a target="_blank" href="https://www.facebook.com/abujaapartments/"><span class="fa fa-facebook"></span></a>
        <a target="_blank" href="https://twitter.com/AbjApartments"><span class="fa fa-twitter"></span></a>
        <!--<a target="_blank" href="https://www.facebook.com/zerothgroup/"><span class="fa fa-linkedin"></span></a>
        <a target="_blank" href="https://www.instagram.com/zerothgrp/"><span class="fa fa-instagram"></span></a>-->
    </div>
</header>
	<div id="header" class="container-fluid">
        
        <div class="col-xs-12 col-md-6">
           <!--<img class="img-responsive" src="images/logo2.png" />-->
           <img class="img-responsive" src="{{env('APP_STORAGE')}}images/Abj_logo.png" />
        </div>
        <div class="col-md-3 col-sm-6 col-sm-push-6 col-md-push-0 search">
            <form action="processes/search_realtor.php" method="post">
                    <input type="hidden" name="active" value="0" />
                    <div class="col-md-9 col-xs-9 no-padding">
                        <input class="form-control input-sm" type="text" name="search_realtor" placeholder="search realtor" required />
                    </div>
                    <div class="col-md-3 col-xs-3 no-padding">
                        <button class="form-control btn-info input-sm" type="submit" name="submit"><span class="fa fa-search"></span></button>
                        <!--<input class="form-control" type="submit" name="submit" value="Search" />-->
                    </div>
                </form>
        </div>
        <div class="col-md-3 col-sm-6 col-sm-pull-6 col-md-pull-0 col-xs-12 head2">
        	@if(Auth::user())
            <div class="col-sm-12 col-xs-12 head3">
                <div class="col-sm-9 col-xs-10 prof_hd">
                <p class="wel">
                    <span class="cap_1st"><i class="fa fa-user"></i> {{Auth::user()->name}}</span>  
                </p>
                @if(Auth::user()->activated==1) 
                    <p class="out"><a href="profile/"><span class="fa fa-address-card-o"></span> My Profile</a> | <a href="{{url('realtor/logout')}}" class=""><span class="fa fa-sign-out"></span> Log Out</a> </p>
                @endif
                @if(Auth::user()->activated==0)
                    <p class="out">
                    <a href="realtors/activate_realtor.php">Become a Realtor</a> and Start posting houses
                    <a href="{{url('realtor/logout')}}"><span class="fa fa-sign-out"></span> Log Out</a>
                    </p>
                @endif
                </div>
                <div class="col-sm-3 col-xs-2 prof_img_hd">
                    @if(!empty(Auth::user()->profile_photo)) 
                     <img src="{{env('APP_STORAGE')}}images/profile_photos/{{Auth::user()->profile_photo}}" class="img-responsive" />
                    @else
                        <img src="{{env('APP_STORAGE')}}images/profile_photos/no_photo.jpg" class="img-responsive" />
                    @endif
                </div> 

                <div class="col-sm-12 col-xs-12 head_biz">
                    @if(Auth::user()->type != 'company')
                        <!--<a href="index.php?page=wall"><span class="fa fa-angle-double-right"></span> My Wall</a> | -->
                    @endif
                    @if(Auth::user()->activated==1)
                        <a href="{{Auth::user()->profile_name}}"><span class="fa fa-angle-double-right"></span> Business Page</a> | 
                        @if(Auth::user()->activated==1)
                            <a href="realtor/" target="_blank"><span class="fa fa-angle-double-right"></span> Admin</a>
                        @endif
                
                    @endif
                </div><!-- end of head_biz -->

            </div>
            @else
                <div class="col-sm-12">
        			<div class="log">
                    	<a href="realtor/login"><span class="fa fa-sign-in"></span> Login</a> |
                        
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript::void(0)">Register <span class="caret"></span></a> 
                    	<ul class="dropdown-menu">
                            <li><a href="{{url('realtor/register')}}">Individual</a></li> 
                            <li><a href="{{url('realtor/register/company')}}">Company</a></li> 
                        </ul>
                    </div>
                </div>
            @endif
            
        </div><!-- End of head2 -->
        
    </div>

<script type='application/javascript'>
    $(document).on('click', '.dropdown-toggle', function() { 
        var toggle = $(this).data('toggle');
        
        if(toggle=='dropdown') { 
            $(this).siblings('ul .dropdown-menu').css('display', 'block');
            //alert(toggle);
        }
        //return false;
    })
</script>