@include('inc.realtor.agent_head_links')

@extends('layouts.realtor')

@section('content')
<div class="container no-padding cont_sm">

	<div id="left-side" class="hidden-xs col-md-2 col-sm-2">
		<div class="col-sm-12 left_prof_cont">
            <a href="{{url('realtor/profile')}}" >
	        	@if(!empty($realtor->profile_photo))
	              <img src="{{env('APP_STORAGE')}}images/profile_photos/{{$realtor->profile_photo}}" class="img-responsive" />
	            @else
	              <img src="{{env('APP_STORAGE')}}images/profile_photos/no_img.png" class=" img-responsive" />
	            @endif
            </a>
	        <!--<div class="left_prof">
	           	<a href="{{url('realtor/profile')}}" ><span class="fa fa-address-card-o"></span> My Profile</a>
	        </div>-->
        </div>
	</div>

	<div id="main-content" class="col-md-10 col-sm-10 no-padding">
	   	<div class="panel panel-default">
	   		<div class="panel-heading">
			    <h3 class="panel-title">Agent's Page</h3>
                <p class="information text-center">

                	<!--
                    <p class="alert-success" style="color: blue">
	                    You are eligible for a website from our partners <b><a href="http://zizix6.com" target="new">Zizix6 Nig Ltd</a></b> at 25% discount<br/>
	                    Your Promo Code is <b>"<?php //echo $promo->code; ?>"</b><br/>
	                    Go to <a href="http://zizix6.com" target="new">zizix6/promo</a> and enter your promo code or
	                    click on <a href="http://zizix6.com" target="new">zizix6/promo/<?php //echo $promo->code; ?></a> to claim your promo<br/>
	                    You can also give another person the promo code to claim the promo if you already have a website 
	                    or don't need one.
                    </p>
                    -->
                    <span>IMPORTANT:</span> 
                        Your Personalized Page is 
                    <a href="https://www.abujaapartments.com.ng/{{$realtor->profile_name}}">
                        <i>https://www.abujaapartments.com.ng/{{$realtor->profile_name}}</i>
                    </a>&nbsp; 
                        Use this url to advertise your house portfolio to prospective Clients
                </p>
			</div> 

			@include('inc.realtor.houses')


		</div>
	</div>
</div>



@endsection