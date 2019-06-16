{{-- @include('inc.realtor.company_head_links') --}}

@extends('layouts.realtor')

@section('content')

<div id="main-content" class="content__right__main">
	<div id="left-side" class="col-md-2 col-sm-2">
		<ul class="no-padding">	
            <li><a href="{{url('realtor/estates')}}"><span class="fa fa-building"></span> Estates <span class="fa fa-angle-double-right"></span></a> </li>
            <li><a href="{{url('realtor/houses')}}"><span class="fa fa-building-o"></span> Houses <span class="fa fa-angle-double-right"></span></a> </li>
        </ul>
        <div class="hidden-xs col-sm-12 left_prof_cont">
            @if(!empty($realtor->profile_photo))
              <img src="{{env('APP_STORAGE')}}images/profile_photos/{{$realtor->profile_photo}}" class="img-responsive" />
            @else
              <img src="{{env('APP_STORAGE')}}images/profile_photos/no_img.png" class=" img-responsive" />
            @endif
            <div class="left_prof">
                <a href="{{url('realtor/profile')}}" ><span class="fa fa-address-card-o"></span> My Profile</a>
            </div>
        </div>
	</div>

	 <div id="main-content" class="col-md-10 col-sm-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Estate Management Firm</h3>
                <p class="information text-center">
                    	<span>IMPORTANT:</span> 
                        Your Personalized Page is 
                        <a href="https://www.abujaapartments.com.ng/{{$realtor->profile_name}}">
                        <i>https://www.abujaapartments.com.ng/{{$realtor->profile_name}}</i>
                        </a>&nbsp; 
                        Use this url to advertise your house portfolio to prospective Clients
                    </p>
            </div>
            <div class="panel-body color company">

            	@include('inc.realtor.houses')

            </div>
        </div>

    </div>

</div>

@endsection