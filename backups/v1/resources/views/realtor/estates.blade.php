@include('inc.realtor.company_head_links')

@extends('layouts.realtor')

@section('content')

<div class="container no-padding cont_sm">
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

            	<h4> Estates Portfolio <span class="fa fa-angle-right"></span> <a href="index.php?page=add estate"><small class="smll">Add Estate <span class="fa fa-plus-square"></span></small></a></h4>

            	@if($realtor->estates->count() == 0) { ?>
					<p>There are No Estates in Your Portfolio Yet </p>
				@else
					<div class="col-md-12 col-sm-12 est_cont">
						@foreach($realtor->estates as $estate)
							<div class="col-md-3 col-sm-3 col-xs-6 no-padding est_xs">
								<div class="est_img">
									<a href="{{url('realtor/estate/'.$estate->id)}}">
										@if(App\Estate_photo::GetMainPhoto($estate->id)->count())
	                                    	<img class="img-responsive img-thumbnail" src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{App\Estate_photo::GetMainPhoto($estate->id)->first()->photo}}" />
		                                @elseif(App\Estate_photo::GetEstatePhotos($estate->id)->count())
		                                    <img class="img-responsive img-thumbnail" src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{App\House_photo::GetEstatePhotos($estate->id)->first()->photo}}" />
		                                @else
		                                    <img class="img-responsive img-thumbnail" src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
		                                @endif
		                                <br/>
									</a>
								</div>
								<div class="est_des">
									<p><span class="fa fa-tag"></span> {{$estate->name}}
									<br/>
									<span class="fa fa-map-marker"></span> {{$estate->location->name}}
									</p>
									<p class="no-padding">
										<a href="{{url('realtor/estate/'.$estate->id)}}"><span class="fa fa-eye"></span> 
											View
										</a>
								   		&nbsp;<a href="{{url('realtor/delete_estate/'.$estate->id)}}" onClick="return confirm('Are You Sure You Want To Delete This Estate?')"><span class="fa fa-trash"></span> Delete</a>
							   		</p>
							   	</div>
							</div>
						@endforeach
					</div>
				@endif

            </div>
        </div>

    </div>

</div>

@endsection