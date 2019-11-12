<div class="overlay" id="profileOverlay">
    @if(Auth::user())
    <div class="overlay__container">
        <div class="overlay__container__close" id="profileOverlayClose"> <i class="fas fa-times"></i></div>
        <div class="overlay__container__content">
            <div class="overlay__container__content__img">
                @if(!empty(Auth::user()->profile_photo)) 
                    <img src="{{env('APP_STORAGE')}}images/profile_photos/{{Auth::user()->profile_photo}}" class="img-responsive" />
                @else
                    <img src="{{asset('images/profile_pic2.png')}}" class="img-responsive" />
                @endif
            </div>
            <div class="overlay__container__content__details">
                <div class="overlay__container__content__details__name">
                    @if(Auth::user()->type == 'company')
                        {{Auth::user()->biz_name}} 
                    @else
                        
                        {{Auth::user()->firstname}} {{Auth::user()->lastname}}
                    @endif
                </div>
                @if(Auth::user()->activated==1) 
                    <div class="row overlay__container__content__details__others">
                        <div class="col-lg-7"><a href="profile/">My Profile</a></div>
                        <div class="col-lg-5"><a href="realtor/" target="_blank">Admin</a></div>
                    </div>
                    <div class="row overlay__container__content__details__others">
                        <div class="col-lg-7"><a href="{{Auth::user()->profile_name}}">Business Page</a></div>
                        @if(Auth::user()->type != 'company')
                        <div class="col-lg-5">
                            <a href="index.php?page=wall"> My Wall</a>
                        </div>
                        @endif
                    </div>
                    
            @else
                    <div class="row overlay__container__content__details__others"><a href="realtors/activate_realtor.php">Become a Realtor</a> and Start posting houses</div>
                @endif
                <div class="overlay__container__content__details__logout"><a href="{{url('realtor/logout')}}"><span class="fas fa-sign-out-alt"></span> Log Out</a></div>
            </div>
        </div>
    </div>
    @endif
</div>

<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="APP_URL" value="{{ env('APP_URL') }}">
<input type="hidden" name="APP_STORAGE" value="{{ env('APP_STORAGE') }}"> 
    @include('inc.analyticstracking')

	<div id="header" class="container-fluid " style="top: 0px;">
        
        <div class="row header">
            {{-- <div class="col-3 d-flex d-sm-none justify-content-center align-items-center">
                <button type="button" class="collapseBtn" id="toggleFilter">
                    <div class="longBar my-2"></div>
                    <div class="shortBar"></div>
                    <div class="longBar my-2"></div>
                </button>
            </div> --}}
            <div class="col-6 col-lg-3 header__img">
                <img class="img-responsive" src="{{ asset('images/logo1.png') }}" /> 
            </div>
            <div class="col-6 col-lg-9 header__content ">
                <div class="col-lg-12 p-0 header__content__sm d-xl-block d-sm-flex justify-content-end">
                    <nav class="navbar navbar-expand-lg navbar-light header__content__navbar py-0">
                        <button class="navbar-toggler collapseBtn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            {{-- <span class="navbar-toggler-icon"></span> --}}
                            <div class="longBar my-2"></div>
                            <div class="longBar"></div>
                            <div class="longBar my-2"></div>
                        </button>

                        <div class="collapse navbar-collapse header__content__navbar__list mb-2 d-none d-sm-block" id="navbarSupportedContent">
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
                                @if(!Auth::user())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Register
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="dropdown-menu">
                                            <a class="dropdown-item" href="{{ url('register') }}">Individual</a>
                                            <a class="dropdown-item" href="{{ url('register/company')}}">Company</a>
                                        </div>
                                    </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" style="border-radius: 20px;" href="{{url('realtor/logout')}}">
                                        <span class="far fa-sign-out"></span> Log Out</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <button class="btn btn-outline-primary roundedSearch" id="displaySearch">
                                        <i class="fa fa-search"></i></button>
                                </li> --}}
                            </ul>
                            
                            @if (Auth::user())
                                <div class="header__content__navbar__list__img" id="clickOnPhoto">
                                    @if(!empty(Auth::user()->profile_photo)) 
                                        <img src="{{env('APP_STORAGE')}}images/profile_photos/{{Auth::user()->profile_photo}}" class="img-responsive" />
                                    @else
                                        <img src="{{asset('images/profile_pic2.png')}}" class="img-responsive" />
                                    @endif
                                </div>
                            @endif
                        </div>
                    </nav>
                </div>

            </div>
            
        </div>
        

        <!-- Mobile header drop down -->
        <div class="collapse navbar-collapse header__content__navbar__list mb-2 " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto d-flex flex-row d-sm-none">
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
                @if(!Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapseExample" role="button" 
                        aria-expanded="false" aria-controls="collapseExample">
                            Register <span class="fa fa-caret-down"></span>
                        </a>
                    </li>
                    <div class="collapse text-center" id="collapseExample" style="width: 100%;">
                        <a class="dropdown-item" href="{{ url('register') }}">Individual</a>
                        <a class="dropdown-item" href="{{ url('register/company')}}">Company</a>
                    </div>
                @else
                    <li class="nav-item">
                        <a class="nav-link" style="border-radius: 20px;" href="{{url('realtor/logout')}}">
                            <span class="far fa-sign-out"></span> Log Out</a>
                    </li>
                @endif
                {{-- <li>
                    <button class="btn btn-outline-primary roundedSearch" id="phoneDisplaySearch">
                        <i class="fa fa-search"></i></button>
                </li> --}}
            </ul>
            
            @if (Auth::user())
                <div class="header__content__navbar__list__img" id="clickOnPhoto">
                    @if(!empty(Auth::user()->profile_photo)) 
                        <img src="{{env('APP_STORAGE')}}images/profile_photos/{{Auth::user()->profile_photo}}" class="img-responsive" />
                    @else
                        <img src="{{asset('images/profile_pic2.png')}}" class="img-responsive" />
                    @endif
                </div>
            @endif
        </div>

        
    </div>

