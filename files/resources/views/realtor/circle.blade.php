{{-- @if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif --}}

@extends('layouts.realtor')

@section('content')

<div class="extra_pages">
	<h4 class="extra_pages__title"><i class="fa fa-bullseye"></i> My Circles </h4>

	<div class="extra_pages__body row">
		@if(empty($circle)) <span class='size'>There are no realtors in your circle</span> @else
		@php $n = 0; @endphp
		@foreach($circle as $rship) 
			<div class="col-lg-3">
				<div class="extra_pages__body__each">
					@php $n++; @endphp
					@if($rship->user_one == Auth::user()->id)
						@php $realtor = $rship->userTwo; @endphp
					@else
						@php $realtor = $rship->userOne; @endphp
					@endif

					{{-- <span class="bagde badge-info">{{$n}}</span> --}}
					<div class="extra_pages__body__each__img">
						<img class="img-circle" src="{{env('APP_STORAGE')}}images/profile_photos/@if(empty($realtor->profile_photo))no_photo.jpg @else{{$realtor->profile_photo}} @endif" />
					</div>
					<div class="extra_pages__body__each__details">
						<a href="{{url($realtor->profile_name)}}" target="blank">{{$realtor->name}}</a>
						<p class="mb-2">
							<?php echo $realtor->profile_name; ?>
						</p>
						
						{!! Form::open(['action' => ['Realtor\CircleController@delete'], 'method'=>'POST',  'style'=>"display:inline-block"]) !!}
							<input type="hidden" name="circle_id" value="{{$rship->id}}" />
							<input type="hidden" name="realtor_id" value="{{$realtor->id}}" />
							<button class="btn btn-danger btn-sm" type="submit" name="submit" value="" ><i class="fa fa-times"></i> Remove</button>
							<!--<input class="btn-success" type="submit" name="submit" value="Remove From Circle" />-->
						{!! Form::close() !!}
					</div>
				</div>

			</div>
			
		@endforeach
		@endif
	</div>
	

</div>

@endsection
   
@section('js')

<script type="application/javascript">
 $('form[name=remove]').submit(function(e) {
    return confirm('Removing this realtor from your circle will remove all the houses shared between you and the realtor!! \nDo you still want to go ahead?');
});
</script>
@endsection