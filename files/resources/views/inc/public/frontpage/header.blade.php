<body>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="APP_URL" value="{{ env('APP_URL') }}">
<input type="hidden" name="APP_STORAGE" value="{{ env('APP_STORAGE') }}"> 
    @include('inc.analyticstracking')

	<div id="header" class="container-fluid">
        <div class="row">
            
            <div class="col-lg-3">
                <img class="img-responsive" src="{{ asset('images/logo.png') }}" /> 
            </div>
            <div class="col-lg-9 border border-danger">
                <ul class="">
                    <li><a href="{{ url('')}}">HOME</a></li>
                    <li><a href="{{ url('about')}}">ABOUT US</a></li>
                    <li><a href="{{ url('partner')}}">PARTNER WITH US</a></li>
                    <li><a href="{{ url('contact')}}">CONTACT US</a></li>
                </ul>
            </div>
            
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
                    <p class="out"><a href="profile/"><span class="fa fa-address-card-o"></span> My Profile</a> | <a href="logout.php" class=""><span class="fa fa-sign-out"></span> Log Out</a> </p>
                @endif
                @if(Auth::user()->activated==0)
                    <p class="out">
                    <a href="realtors/activate_realtor.php">Become a Realtor</a> and Start posting houses
                    <a href="logout.php"><span class="fa fa-sign-out"></span> Log Out</a>
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
                            <a href="realtors/" target="_blank"><span class="fa fa-angle-double-right"></span> Admin</a>
                        @endif
                
                    @endif
                </div><!-- end of head_biz -->

            </div>
            @else
                <div class="col-sm-12">
        			<div class="log">
                    	<a href="realtor/login"><span class="fa fa-sign-in"></span> Login</a> |
                        
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Register <span class="caret"></span></a> 
                    	<ul class="dropdown-menu">
                            <li><a href="realtors/register.php">Individual</a></li> 
                            <li><a href="realtors/company_register.php">Company</a></li> 
                        </ul>
                    </div>
                </div>
            @endif
            
        </div><!-- End of head2 -->
        
    </div>