@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor')

@section('content')

<div class="col-sm-12 col-md-9 v_cont">
	<h4 class="pull-right">
        <a class="white" href="{{url('realtor/houses')}}"><i class="fa fa-reply"></i> Back to Houses</a>
    </h4>
    @if($house->estate_id > 0)
    	<h4>
	        <a class="white h3" href="{{url('realtor/estate/'.$house->estate_id)}}">{{$house->estate->name}} </a>
	    </h4>
    @endif
    <h4> <i class="fa fa-building-o"></i> House - {{$house->title}}</h4>
    @if($house->is_shared())
    	<p class="green">This House was Shared by {{$realtorHouse->realtor->name}}</p>
    @endif
    <div class="col-sm-7 no-padding">
    	<div class="row no-margin"> 
            <div id="full-images" class="">
                @foreach($house->house_photos as $photo)
	                <div class="">  
	                    <img class="img-thumbnail house-img" id="{{$photo->id}}" src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/{{$photo->photo}}" @if($photo->main == 1) style="z-index:1;" @endif />
	                </div>
                @endforeach
            </div>
        </div>
        @if(request()->session()->exists('photo_msg'))
			<p class="alert-success">{{session('photo_msg')}} </p>
		@endif

		<div class="row no-margin">
            <ul id="thumbnails" class="no-padding" data-id="{{$house->id}}" >
                @foreach($house->house_photos as $photo) 
                    <li class="col-sm-4 no-padding">
                        <div class="view_img">
                            <img class="house-timthumb img-responsive img-thumbnail" data-id="{{$photo->id}}" src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{$photo->photo}}"/>
                        </div>
                        @if(!$house->is_shared())
                        	<p>
	                            <input type="radio" name="main" data-id="{{$photo->id}}" @if($photo->main==1) checked @endif />
	                            <a href="{{url('realtor/edit_photo/'.$photo->id)}}">
	                            	<button class="btn-info"><i class="fa fa-edit"></i> Edit</button>
	                            </a>
	                            <a href="{{url('realtor/delete_photo/'.$photo->id)}}" onClick="return confirm('Are You Sure You Want To Delete This Photo?')"> <i class="fa fa-trash-o"></i> Delete</a><br class="hidden-xs">
	                            <span class="cap_1st"><i class="fa fa-caret-right"></i> {{empty($housePhoto->title) ? 'Untitled' : $photo->title}}</span>
                        	</p>
                    	@endif
                    </li>
                @endforeach
                <div class="clear"></div>
            </ul>
        </div>
        <div class="row no-margin ad_photo">   
            @if(!$house->is_shared())
	            <form action="index.php?page=add photo" method="post" enctype="multipart/form-data" class="no-margin">
	            	<div class="col-sm-6 col-xs-7 no-padding in1">
	                	<input type="number" name="no" value="1" size="2" class="text" />
	             	</div>   
	                <input type="hidden" name="photo_id" value="{{$photo->id}}" />
	                <input type="hidden" name="folder" value="{{env('APP_STORAGE')}}images/houses/{{$photo->id}}/" />
	                <div class="col-sm-3 col-xs-5 no-padding in2">
	                	<input type="submit" name="submit" value="Add Photo(s)" class="btn-warning text" />
	                </div>   
	            </form> 
            @endif 
        </div>
        <div class="clear"></div>
    </div>
    <div id="house-info" class="col-sm-5">
    	<div class="col-sm-12 house_informatn no-padding">
    		<p class="succ">
	        	@if(request()->session()->exists('edit_house'))
					<p class="alert-success">{{session('edit_house')}} </p>
				@endif
	        </p>
	        <h4 id="drop_des"> <i class="fa fa-edit"></i> House Information <i class="fa fa-caret-down"></i> 
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#hz_informatn">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	        </h4>
	        <div id="hz_informatn" class="collapse navbar-collapse col-sm-12 no-padding">
	        	<ul class="no-margin">
	        		<div class="li_1st">
	                    <li class="col-sm-9 no-padding"><small class="fa fa-map-marker"></small> Location   <small class="fa fa-angle-double-right"></small> {{$house->location->name}} </li>
	                    <li class="col-sm-3 no-padding cap_1st">For {{$house->status}}</li>
	                    <div class="clear"></div>
	                </div>
	                <div class="li_2nd">
	                    <li class="">Name <small class="fa fa-angle-double-right"></small> {{$house->title}} </li>
						<li><small class="fa fa-tag"></small> Price <small class="fa fa-angle-double-right"></small> @if(!empty($house->price))
							₦ {{number_format($house->price)}}
						@else
							<i style="color:red">Info Not available</i>
						@endif
						</li>
	                    <li><small class="fa fa-tag"></small> Agent Fee <small class="fa fa-angle-double-right"></small>@if(!empty($house->agent_fee)) 
	                    	₦ {{number_format($house->agent_fee)}} 
	                    @else
	                    	<i style="color:red">Info Not available</i>'
	                    @endif
	                    </li>
	                    <li><small class="fa fa-tag"></small> Service Charge <small class="fa fa-angle-double-right"></small> @if(!empty($house->service_charge))
	                    	₦ {{number_format($house->service_charge)}} 
	                    @else
	                    	<i style="color:red">Info Not available</i> 
	                    @endif
	                    </li>
	                    <div class="clear"></div>
	                </div>
                	<div class="li_3rd">
	                    <li class="col-sm-7 no-padding"><i class="fa fa-clone"></i> House Type <small class="fa fa-angle-double-right"></small> {{$house->house_type->type}} </li>
	                    <li class="col-sm-5 no-padding"><i class="fa fa-bed"></i> Bedrooms {{$house->bedrooms}} </li>
	                    <div class="clear"></div>
	                </div> 
	                <div class="li_3rd">   
	                    <li class="col-sm-7 no-padding"><i class="fa fa-list-ul"></i> 
	                        Total Rooms: @if(!empty($house->rooms)) 
	                        				{{$house->rooms}}
	                        			@else 
	                        				<i style="color:red">Info Not available</i> 
	                        			@endif
	                    </li>
	                    <li class="col-sm-5 no-padding"><i class="fa fa-bath"></i> 
	                        Toilets: @if(!empty($house->toilets))
	                        		 	{{$house->toilets}} 
	                        		 @else
	                        		 	<i style="color:red">Info Not available</i>
	                        		 @endif 
	                    </li>
	                    <div class="clear"></div>
	                </div>
	                <div class="li_3rd"> 
	                    <li class="col-sm-7 no-padding"><i class="fa fa-tint"></i> Water Source <small class="fa fa-angle-double-right"></small> @if(!empty($house->water_source))
	                    									{{$house->water_source}}
	                    								@else
	                    									<i style="color:red">Info Not available</i>
	                    								@endif 
	                    </li> 
	                    <li class="col-sm-5 no-padding"><i class="fa fa-shower"></i> 
	                        Bathrooms @if(!empty($house->bathrooms))
	                        		  	{{$house->bathrooms}} 
	                        		  @else
	                        		  	<i style="color:red">Info Not available</i>
	                        		  @endif 
	                    </li>
	                    
	                    <div class="clear"></div>
	                </div>
	        	</ul>
	        	
	        	@if($house->status=='sale')
	                <div class="desc_realtor" style="margin-bottom: 5px;">
	                    <div class="desc_hd">Sale Plan <small class="fa fa-caret-down"></small> </div>
	                    <div class="desc_body">
	                        <p>
	                        	@if(!empty($house->sale_plan)) 
	                        		<?php echo $house->sale_plan; ?>
	                        	@else
	                        		<i style="color:pink">Info Not available</i>
	                        	@endif
	                        </p> 
	                    </div>
	                    <div class="clear"></div>
	                </div>
	            @endif

	            <div class="desc_realtor">
	                <div class="desc_hd">Facilities <small class="fa fa-caret-down"></small> </div>
	                <div class="desc_body">
	                    <p>
	                    @if(!empty($house->facilities))
	                    	{{$house->facilities}}
	                    @else
	                    	<i style="color:pink">Info Not available</i>
	                    @endif
	                     </p> 
	                </div>
	                <div class="clear"></div>
	            </div>

	            <div class="desc_realtor">
	                <div class="desc_hd">Description <small class="fa fa-caret-down"></small> </div>
	                <div class="desc_body">
	                    <p>
	                    	@if(!empty($house->description))
	                    		{{$house->description}} 
	                    	@else
	                    		<i style="color:pink">Info Not available</i>
	                    	@endif
	                     </p> 
	                </div>
	                <div class="clear"></div>
	            </div>

	            @if(!$house->is_shared())
		            <div class="info_edit no-margin">
		                <a class="btn btn-default col-sm-12 col-xs-12" href="{{url('realtr/edit_house/'.$house->id)}}">
		                    <i class="fa fa-edit"></i> Edit House Information
		                </a>
		            </div>
		        @endif

		        <div class="clear"></div>
	        </div>
    	</div>
	</div>
	<div class="clear"></div>
</div>

<div class="col-sm-12 col-md-3 col-sm-12 cont_un">
    @if(!$house->is_shared()) //If the house is not a shared house, Go ahead and share if you wish ?>
		<div id="availability" class="aval1" data-id="{{$house->id}}">
	        @if($house->available==1)
	      		<b class="aval">
	        		This House is available
	            </b>
	            <button type="button" data-id="0" class="btn btn-danger"><i class="fa fa-bookmark-o"></i> Make this house unavailable</button>
	        @endif
	        @if($house->available==0)
	      		<b class="unaval">
	        		This House is unavailable
	            </b>
	            <button type="button" data-id="1" class="btn btn-success"> <i class="fa fa-bookmark"></i> Make this house available</button>
	        @endif
	    </div>
	    <div class="bt">
		    <a href="{{url('realtor/share_house/'.$house->id)}}" >
		    	<button type="button" class="btn btn-warning">
		        	<i class="fa fa-share-square-o"></i> Share This House
		    	</button> 
		    </a>
	    </div>
    @endif
</div>

@endsection

@section('js')
<script type="application/javascript">
$(document).ready(function(e) {
    //alert('working');
    CSRF_TOKEN = $('input[name=_token]').val();

	$('.house-timthumb').click(function(e) { 
        var photo_id = $(this).data('id');
    	
		$('.house-img').filter(function() {
		return $(this).css('z-index') == 1;
		}).each(function() {
			$(this).css('z-index', 0);   
		});
		$('#'+photo_id).css('z-index', 1);
	});
	
	$('#thumbnails input').click(function(e) {
		var photo_id = $(this).data('id');
		var house_id = $('#thumbnails').data('id');
        var postFields = {photo_id: photo_id, house_id: house_id, _token: CSRF_TOKEN};
        var postUrl = "{{url('realtor/change_house_mainPhoto')}}";
		$.ajax({
			url:postUrl, 
			data:postFields, 
			type: "post", 
			async: false, 
			success: function(data) { 
				//alert(data);
				$('.house-img').filter(function() {
				return $(this).css('z-index') == 1;
				}).each(function() {
					$(this).css('z-index', 0);   
				});
				$('#'+photo_id).css('z-index', 1);
			}
		}) 
    });
	//$('#availability').click(function(e) {
	$(document).on('click', '#availability button', function(e) {
        var available = $(this).data('id');
		var house_id = $('#availability').data('id');
		var postFields = {house_id: house_id, available: available, _token: CSRF_TOKEN};
        var postUrl = "{{url('realtor/change_house_availability')}}";
		//alert(available);
		$.ajax({
			url:postUrl, 
			data:postFields, 
			type: "post", 
			async: false, 
			success: function(data) { 
			//alert(data);
				if(available==0) {
					//$('#availability b').removeClass('green');
                    $('#availability b').removeClass('aval');
					//$('#availability b').addClass('red');
                    $('#availability b').addClass('unaval');
					$('#availability b').html('This House is unavailable');
					$('#availability button').removeClass('btn-danger');
					$('#availability button').addClass('btn-success');
					$('#availability button').html('<i class="fa fa-bookmark"></i> Make this house available');
					$('#availability button').data('id', 1);
				}
				if(available==1) {
					//$('#availability b').removeClass('red');
                    $('#availability b').removeClass('unaval');
					//$('#availability b').addClass('green');
                    $('#availability b').addClass('aval');
					$('#availability b').html('This House is available');
					$('#availability button').removeClass('btn-success');
					$('#availability button').addClass('btn-danger');
					$('#availability button').html('<i class="fa fa-bookmark-o"></i> Make this house unavailable');
					$('#availability button').data('id', 0);
				}
			}
		}) 
    });
});
</script>
@endsection