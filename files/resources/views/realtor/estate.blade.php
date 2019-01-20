@include('inc.realtor.agent_head_links')

@extends('layouts.realtor')


@section('content')
<h2>MANAGE ESTATE</h2>

<h4>
	{{$estate->name}}
	<span class="fa fa-suitcase"></span> House Portfolio <span class="fa fa-angle-right"></span>
	<a href="{{url('realtor/add_estate_house/'.$estate->id)}}"> 
    	<small class="smll">Add House <span class="fa fa-plus-square"></span></small>
    </a>
</h4>

<div id="estate-photos" style="width: 100%; overflow-x: auto; white-space: nowrap;">
    @foreach($estate->estate_photos as $photo)
            <img src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{$photo->photo}}" width="200" height="150" style="margin-right: 5px;">
    @endforeach
</div>

<ul class="nav nav-tabs">
    <li class="active" data-id="available">
    	<a href="javascript:void(0)"> <span class="fa fa-bookmark"></span> Available Houses</a>
    </li>
    <li data-id="unavailable">
    	<a href="javascript:void(0)"><span class="fa fa-bookmark-o"></span> Unavailable Houses</a>
    </li>
</ul>

@if(request()->session()->exists('success'))
	<p class="alert-success">{{session('success')}} </p>
@endif

<div id="portfolio-grid" class="">            
    <div id="available" class="col-md-12 col-sm-12 col-xs-12 houses">
    	@if($estate->houses->count()==0) 
            <p> No Houses yet under this Estate </p>
        @else
            <ul class="no-padding">
            @foreach($estate->houses as $house) 
            		<div class="col-md-3 col-sm-4 col-xs-6 cont_height">
                		<div class="house_container">
                			<li class="estate">
                				<div class="col-md-12 col-sm-12 img1 no-padding">
                					<a href="{{url('realtor/house/'.$house->id)}}">
	                					@if(App\House_photo::GetMainPhoto($house->id)->count())
	                                        <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetMainPhoto($house->id)->first()->photo}}" />
	                                    @elseif(App\House_photo::GetHousePhotos($house->id)->count())
	                                        <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetHousePhotos($house->id)->first()->photo}}" />
	                                    @else
	                                        <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
	                                    @endif
                    				</a>
                				</div>
                				<div class="col-md-12 col-sm-12 col-xs-12 no-padding"> 
	                    			<b> <span class="fa fa-bed"></span> 
		                    			{{$house->bedrooms}} Bedroom {{$house->house_type->type}}
		                    			<br/>
		                    			<span class="fa fa-map-marker"></span> {{$house->location->name}}
		                    			<span class="pull-right cap_1st re">For {{$house->status}}</span>
		                    			<br/>
	                    			</b>
                    				<div class="no-margin lvd text-center">
                    					<!--<a href="index.php?page=house likes&house_id=<?php //echo $house->house_id; ?>">--> 
                    						<span class="fa fa-thumbs-up"></span> Likes [{{$house->likes}}]&nbsp;&nbsp;
                    					<!--</a>-->
                    					<a href="{{url('realtor/house/'.$house->id)}}"> 
                    						<i class="fa fa-eye"></i> View
                    					</a> &nbsp;&nbsp; 
										<a href="{{url('realtor/delete_house/'.$house->id)}}" onClick="return confirm('Are You Sure You Want To Delete This House?')"> <i class="fa fa-trash-o"></i> Delete</a>
                    				</div>
                				</div>
                			</li>
                			<div class="clear"></div>
                		</div>
            		</div>   
            	@endforeach
            </ul>
        @endif
        <div style="clear:both"></div>
        @if($estate->houses->count() > 0)
			<!--<div class="social">Share on:
				<a class="soc_fb" href="http://www.facebook.com/sharer.php?u=http://www.abujaapartments.com.ng/{{$realtor->profile_name}}" target="_blank" title="Click to share">
			   	<span class="fa fa-facebook"></span>
				</a>

				<a href="https://twitter.com/share" class="soc_tw twitter-share-button"{count} data-text="http://www.abujaapartments.com.ng/{{$realtor->profile_name}}" target="_blank" data-via="abujaapartments"><span class="fa fa-twitter"></span>
				</a>

				<a class="soc_wh" href="whatsapp://send?text=http://www.abujaapartments.com.ng/{{$realtor->profile_name}}" data-action="share/whatsapp/share"><span class="fa fa-whatsapp"></span>
				</a>
				<a class="soc_g" href="https://plus.google.com/share?url=http://www.abujaapartments.com.ng/{{$realtor->profile_name}}" target="_blank">
					<span class="fa fa-google-plus"></span>
				</a>
        	</div>-->
        @endif
    </div>
	<div id="unavailable" class="col-md-12 col-sm-12 houses">
    	<h4 class="blue"><span class="fa fa-bookmark-o"></span> Unavailable Houses</h4>
        @if($estate->Unavailablehouses->count()==0)
    		<p> No Unavailable Houses </p>
    	@else
        <ul class="thumbnails row no-padding">
            @foreach($estate->Unavailablehouses as $house) 
    			<div class="col-md-3 col-sm-4 cont_height">
                    <div class="house_container">
    					<li class="mix estate" >
    						<div class="col-md-12 col-sm-12 img1 no-padding">
                        		<a href="{{url('realtor/house/'.$house->id)}}">
                        			@if(App\House_photo::GetMainPhoto($house->id)->count())
	                                    <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetMainPhoto($house->id)->first()->photo}}" />
	                                @elseif(App\House_photo::GetHousePhotos($house->id)->count())
	                                    <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetHousePhotos($house->id)->first()->photo}}" />
	                                @else
	                                    <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
	                                @endif
                        		</a>
    						</div>

                     		<div class="col-md-12 col-sm-12 no-padding"> 	
                        		<b> <span class="fa fa-bed"></span>{{$realtorHouse->house->bedrooms}} Bedroom {{$house->house_type->type}}
			                    	<br/>
			                    	<span class="fa fa-map-marker"></span> {{$house->location->name}}
			                    	<span class="pull-right cap_1st re">For {{$house->status}}</span>
			                    	<br/>
                        		</b>
                        		<div class="no-margin lvd">
                        			<a href="{{url('realtor/house'.$house->id)}}"> 
                    					<i class="fa fa-eye"></i> View
                    				</a>
                       				<a href="{{url('realtor/delete_house/'.$house->id)}}" onClick="return confirm('Are You Sure You Want To Delete This House?')"> <i class="fa fa-trash-o"></i> Delete</a>
                       			</div>
    						</div>
                    	</li>
                    	<div class="clear"></div>
                    </div>
            	</div>   
    		@endforeach
        </ul> 
        @endif
    </div>
</div>
<script type="application/javascript" src="{{asset('js/app.js')}}"></script>
<script type="application/javascript" src="{{asset('js/jquery.min.js')}}"></script>

<script type="application/javascript">
$(document).ready(function(e) {
	 //alert('working');
	$('.houses').css('display', 'none');
	$('#available').css('display', 'block');
    $('.nav-tabs li').click(function(e) {
       var id = $(this).data('id');
	   $('.houses').css('display', 'none');
	   $('#'+id).css('display', 'block');
	   $('li').each(function(index, element) {
        $(this).removeClass('active');
		$('#'+id).addClass('active');
    });
	   
    });
});
</script>

@endsection