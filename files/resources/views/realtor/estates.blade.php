{{-- @include('inc.realtor.company_head_links') --}}

@extends('layouts.realtor')

@section('content')

<div id="main-content" class="content__right__main">

	@include('inc.realtor.estate.estate_link')
	       
	<div class="content__right__main__houses">
		<h4 class="content__right__main__houses__portfolio">Estates Portfolio  
				<a href="{{url('realtor/add_estate')}}"> 
				Add Estate &nbsp;<i class="fa fa-plus"></i>
				</a>
				{{-- <button type="button" href="#" data-toggle="modal" data-target="#exampleModal">
					Add Estate &nbsp;<i class="fa fa-plus"></i>
				</button> --}}
		</h4>

		{{-- <h4> Estates Portfolio <span class="fa fa-angle-right"></span> <a href="{{url('realtor/add_estate')}}">
			<small class="smll">Add Estate <span class="fa fa-plus-square"></span></small></a></h4> --}}
		
		<div class="estate__container">
			@if($realtor->estates->count() == 0) { ?>
				<p>There are No Estates in Your Portfolio Yet </p>
			@else
				<div class="row">
					@foreach($realtor->estates as $estate)
						<div class="col-lg-3 col-md-4 col-6">
							<div class="estate__container__single">
								<a href="{{url('realtor/estate/'.$estate->id)}}">
									<div class="estate__container__single__img">
										
										@if(App\Estate_photo::GetMainPhotos($estate->id)->count())
											<img class="img-responsive" src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{App\Estate_photo::GetMainPhotos($estate->id)->first()->photo}}" />
										@elseif(App\Estate_photo::GetEstatePhotos($estate->id)->count())
											<img class="img-responsive" src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{App\Estate_photo::GetEstatePhotos($estate->id)->first()->photo}}" />
										@else
											<img class="img-responsive" src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
										@endif
									</div>
								</a>
								<div class="estate__container__single__details">
									<a href="{{url('realtor/estate/'.$estate->id)}}">
										<p class="my-1"> {!! check_string_length($estate->name) !!}</p>
										<p class="my-1"><span class="fa fa-map-marker-alt"></span> {{$estate->location->name}}</p>
									</a>
									<p class="mt-2 text-center">
										<a href="{{url('realtor/delete_estate/'.$estate->id)}}" class="delete"
											onClick="return confirm('Are You Sure You Want To Delete This Estate?')"><span class="fa fa-trash"></span> Delete</a>
									</p>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</div>

    

</div>

@endsection