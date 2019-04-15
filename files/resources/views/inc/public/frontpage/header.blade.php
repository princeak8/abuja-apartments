<body>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="APP_URL" value="{{ env('APP_URL') }}">
<input type="hidden" name="APP_STORAGE" value="{{ env('APP_STORAGE') }}"> 
    @include('inc.analyticstracking')

	<div id="header" class="container-fluid">
        <div class="row pt-2 header">
            
            <div class="col-lg-3 header__img">
                <img class="img-responsive" src="{{ asset('images/logo1.png') }}" /> 
            </div>
            <div class="col-lg-9 header__content">
                <div class="col-lg-12 p-0">
                    <nav class="navbar navbar-expand-lg navbar-light header__content__navbar py-1">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse header__content__navbar__list mb-2" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link make_active" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('partner') }}">Partner us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('about') }}">About us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('contact') }}">Contact us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Register
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('realtor/register') }}">Individual</a>
                                        <a class="dropdown-item" href="{{ url('realtor/company_register')}}">Company</a>
                                    </div>
                                </li>
                            </ul>
                            {{-- <form action="processes/search_realtor.php" method="post" class="form-inline my-2 my-lg-0">
                                <input type="hidden" name="active" value="0" />
                                <input class="form-control mr-sm-2" type="search" name="search_realtor" required placeholder="Search Realtor" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit"><span class="fa fa-search"></span></button>
                            </form> --}}
                        </div>
                    </nav>
                </div>
                <div class="col-lg-12 header__content__search">
                    <form action="processes/search_realtor.php" method="post" class="form-inline col-7 my-2 my-lg-0">
                        <input type="hidden" name="active" value="0" />
                        <input class="form-control col-10" type="search" name="search_realtor" required placeholder="Search Realtor" aria-label="Search">
                        <button class="btn btn-primary my-sm-0 col-2" type="submit" name="submit">
                            <span class="fa fa-search"></span>
                        </button>
                    </form>
                </div>

            </div>
            
        </div>

        
        {{-- <div class="col-md-3 col-sm-6 col-sm-pull-6 col-md-pull-0 col-xs-12 head2">
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
                        <a href="index.php?page=wall"><span class="fa fa-angle-double-right"></span> My Wall</a> |
                    @endif
                    @if(Auth::user()->activated==1)
                        <a href="{{Auth::user()->profile_name}}"><span class="fa fa-angle-double-right"></span> Business Page</a> | 
                        @if(Auth::user()->activated==1)
                            <a href="realtors/" target="_blank"><span class="fa fa-angle-double-right"></span> Admin</a>
                        @endif
                
                    @endif
                </div>

            </div>
            @else
                
            @endif
            
        </div> --}}
        
    </div>