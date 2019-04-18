{{-- @if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif --}}

@extends('layouts.realtor')

@section('content')
<div class="container vhouse">
	<div class="row">
		<div class="col-lg-9 vhouse__left">
			<h4 class="">
				<a class="h3" href="{{url('realtor/houses')}}"><i class="fa fa-arrow-left"></i> Back to Houses</a>
			</h4>
			@if($house->estate_id > 0)
				<h4>
					<a class="h3" href="{{url('realtor/estate/'.$house->estate_id)}}">{{$house->estate->name}} </a>
				</h4>
			@endif
			<h4> <i class="fa fa-building-o"></i> House - {{$house->title}}</h4>
			@if($house->is_shared(Auth::user()->id))
				<p class="green">This House was Shared by {{$realtorHouse->sharer->biz_name}}</p>
			@endif
			<div class="row">
				<div class="col-lg-7 vhouse__left__pic">

					@include('inc.realtor.view_house.image_and_thumb')

					@include('inc.realtor.view_house.add_photo')

				</div>
				<div id="house-info" class="col-lg-5 vhouse__left__detail">
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

							@if(!$house->is_shared(Auth::user()->id))
								<div class="info_edit no-margin">
									<a class="btn btn-default col-sm-12 col-xs-12" href="{{url('realtor/edit_house/'.$house->id)}}">
										<i class="fa fa-edit"></i> Edit House Information
									</a>
								</div>
							@endif

							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-3 border vhouse__right">
			@if(!$house->is_shared(Auth::user()->id)) <?php //If the house is not a shared house, Go ahead and share if you wish ?>
				<div id="availability" class="aval1" data-id="{{$house->id}}">
					@if($realtorHouse->available==1)
						<b class="aval">
							This House is available
						</b>
						<button type="button" data-id="0" class="btn btn-danger"><i class="fa fa-bookmark-o"></i> Make this house unavailable</button>
					@endif
					@if($realtorHouse->available==0)
						<b class="unaval">
							This House is unavailable
						</b>
						<button type="button" data-id="1" class="btn btn-success"> <i class="fa fa-bookmark"></i> Make this house available</button>
					@endif
				</div>
				@if($realtorHouse->available==1)
					<div class="bt">
						<a href="{{url('realtor/share_house/'.$house->id)}}" >
							<button type="button" class="btn btn-warning">
								<i class="fa fa-share-square-o"></i> Share This House
							</button> 
						</a>
					</div>
				@endif
			@endif
		</div>
	</div>
</div>
@endsection

@section('js')

@include('inc.realtor.add_house_js')

<script type="application/javascript">
$(document).ready(function(e) {
    //alert('working');
    CSRF_TOKEN = $('input[name=_token]').val();

    $('#add-photo-btn').click(function(){
    	var open = $(this).data('open');
    	if(open==0) {
    		$('#add-photo-form').css('display', 'block');
    		$(this).data('open', '1');
    	}
    	if(open==1) {
    		$('#add-photo-form').css('display', 'none');
    		$(this).data('open', '0');
    	}
    })

    $(document).on('click', '.edit-control', function() {
    	var id = $(this).data('id');
    	var open = $(this).data('open');
    	if(open==0) {
    		var button = '<button id="close-btn" class="edit-control btn btn-primary" data-id="'+id+'" data-open="1">Close</button>'
    		$('#control-group-'+id).css('display', 'none');
    		$('#photo_title-'+id).css('display', 'none');
    		$('#edit-form-'+id).css('display', 'block');
    		$('#photo-'+id).append(button);
    	}else{
    		$('#edit-form-'+id).css('display', 'none');
    		$('#info'+id).css('display', 'none');
    		$('#close-btn').remove();
    		$('#edit-form-'+id+' form input[type=reset]').trigger('click');
    		$('#control-group-'+id).css('display', 'block');
    		$('#photo_title-'+id).css('display', 'block');
    	}
    })

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

    $('.delete-btn').click(function() {
    	if(confirm('Are You Sure That You Want to Delete This Photo?')) {
    		var id = $(this).data('id');
    		var postFields = {photo_id: id, _token: CSRF_TOKEN};
        	var postUrl = "{{url('realtor/delete_photo')}}";
        	$.ajax({
				url:postUrl, 
				data:postFields, 
				type: "post", 
				async: false, 
				success: function(data) { 
				//alert(data);
					if(data==1) {
						$('#photo-group-'+id).css('display', 'none');
					}
				}
			})//end of ajax
    	}
    })

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