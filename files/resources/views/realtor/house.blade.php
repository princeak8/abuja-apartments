{{-- @if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif --}}

@extends('layouts.realtor')

@section('content')
<div class="container vhouse">
	<div class="row">
		<div class="col-lg-12 vhouse__left">
			<div class="">
				<div class="vhouse__left__title row">
					<div class="col-12">
						<div class="vhouse__left__title__1">
							@if($house->estate_id > 0)
								<h5 class="text-center">
									<a class="" href="{{url('realtor/estate/'.$house->estate_id)}}">{{$house->estate->name}} </a>
								</h5>
							@endif
						</div>
						<div class="vhouse__left__title__2">
							<h5>
								{{-- <a class="h3" href="{{url('realtor/houses')}}"><i class="fa fa-caret-left"></i> Back to Houses</a> --}}
								<a class="btn btn-sm btn-outline-primary" href="{{url('realtor/houses')}}"><i class="fa fa-caret-left"></i> Back </a>
							</h5>
							
							<h5>
								{{$house->title}} 
								@if($house->is_shared(Auth::user()->id))
									<span class="green">This House was Shared by {{$realtorHouse->sharer->biz_name}}</span>
								@endif
							</h5>
							<h5>
								<a class="btn btn-outline-primary btn-sm" href="{{url('realtor/edit_house/'.$house->id)}}">
									<i class="fa fa-edit"></i> Edit House 
								</a>
							</h5>
						</div>
						
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 vhouse__left__pic">

						@include('inc.realtor.view_house.image_and_thumb')

						@include('inc.realtor.view_house.add_photo')

					</div>
					<div id="house-info" class="col-lg-4 vhouse__left__detail px-2">
						@include('inc.realtor.view_house.house_information')
					</div>
				</div>

			</div>
		</div>

		{{-- <div class="col-lg-3 border vhouse__right">
			@include('inc.realtor.view_house.house_status')
		</div> --}}
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
    		// $('#add-photo-form').css('display', 'block');
    		$('#add-photo-form').slideToggle();
    		$(this).data('open', '1');
    	}
    	if(open==1) {
    		$('#add-photo-form').slideToggle();
    		// $('#add-photo-form').css('display', 'none');
    		$(this).data('open', '0');
    	}
    })

    $(document).on('click', '.edit-control', function() {
    	var id = $(this).data('id');
    	var open = $(this).data('open');
    	if(open==0) {
    		// var button = '<button id="close-btn" class="edit-control btn-sm btn btn-primary" data-id="'+id+'" data-open="1">Close</button>'
    		var button = '<button id="close-btn" class="edit-control btn-sm btn btn-outline-primary" data-id="'+id+'" data-open="1"><i class="fa fa-times"></i></button>'
    		
			$('#control-group-'+id).css('display', 'none');
    		$('#photo_title-'+id).css('display', 'none');
    		// $('#edit-form-'+id).css('display', 'block');
			$('#edit-form-'+id).slideToggle();
    		// $('#photo-'+id).append(button);
			$('#close_'+id).append(button);
    	}else{
    		// $('#edit-form-'+id).css('display', 'none');
    		$('#edit-form-'+id).slideToggle();
    		$('#info'+id).css('display', 'none');
    		$('#close-btn').remove();
    		$('#edit-form-'+id+' form input[type=reset]').trigger('click');
    		$('#control-group-'+id).css('display', 'flex');
    		// $('#photo_title-'+id).css('display', 'block');
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
                    // $('#availability b').removeClass('aval');
					//$('#availability b').addClass('red');
                    // $('#availability b').addClass('unaval');
					$('p.status').html('This House is unavailable');
					$('p.status').addClass('unavailable');
					$('p.status').removeClass('available');
					$('#availability button').removeClass('btn-danger');
					$('#availability button').addClass('btn-success');
					$('#availability button').html('Make this house available');
					$('#availability button').data('id', 1);
					$('#avail_share').hide();
				}
				if(available==1) {
					//$('#availability b').removeClass('red');
                    // $('#availability b').removeClass('unaval');
					//$('#availability b').addClass('green');
                    // $('#availability b').addClass('aval');
					$('p.status').html('This House is available');
					$('p.status').removeClass('unavailable');
					$('p.status').addClass('available');
					$('#availability button').removeClass('btn-success');
					$('#availability button').addClass('btn-danger');
					$('#availability button').html('Make this house unavailable');
					$('#availability button').data('id', 0);
					$('#avail_share').show();
				}
			}
		}) 
    });
});
</script>
@endsection