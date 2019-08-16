{{-- @if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif --}}

@extends('layouts.realtor')

@section('content')

<div class="addhouse_container content__right__main px-2">
	<div class="content__right__main__estate border-radius-big shadow px-4 py-2">
		<div class="content__right__main__estate__title py-2">
			<?php if(isset($_SERVER['HTTP_REFERER'])) { ?>
				<h4>
					<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fa fa-caret-left"></i> Back</a>
				</h4>
			<?php } ?>

			<h3> New House </h3>
		</div>

		<p>@include('inc.errors')</p>
		
		@if(request()->session()->exists('error'))
			<p class="alert alert-danger py-1">{{session('error')}} </p>
		@endif
		
		{!! Form::open(['action' => ['Realtor\HouseController@save'], 'method'=>'POST',  'enctype'=>"multipart/form-data"]) !!}
		
			<!-- Form Field for the TITLE -->
			<div class="form-group">
				<label for="name"><b class="burgundy">* </b><span class="brand-color-darker">Title or Address</span></label>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
					<input id="name" type="text" name="title" class="form-control form-control-sm" required placeholder="Title or Address" value="{!! old('title') !!}" />
				</div>
			</div>

			<!-- Form-group containing three form fields LOCATION, HOUSE TYPE and NO OF BEDROOMS -->
			<div class="form-group row">
			<!--LOCATION OF HOUSE-->
				<div class="col-lg-4">
					<label for="location"><b class="burgundy">* </b><span class="brand-color-darker">Location</span></label>
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fa fa-map-marker-alt"></i></div>
						</div>
						<select id="location" name="location_id" class="form-control form-control-sm" required >
							<option value="">Select a location</option>
								@foreach($locations as $location)
								<option @if(old('location_id') && (old('location_id')==$location->id)) selected @endif value="{{$location->id}}"> {{$location->name}}</option>
							@endforeach
						</select>
					</div>
						
				</div>
				<!-- HOUSE TYPE -->
				<div class="col-lg-4">
						<label for="type"><b class="burgundy">* </b><span class="brand-color-darker">House type</span></label>
							
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fa fa-home"></i></div>
							</div>
							<select id="type" name="house_type_id" class="form-control form-control-sm" required >
								<option value="">Select House type</option>
									@foreach($house_types as $house_type)
										<option @if(old('house_type_id') && (old('house_type_id')==$house_type->id)) selected @endif value="{{$house_type->id}}">
												{{$house_type->type}}
										</option>
									@endforeach
							</select>
						</div>
				</div>

				<!-- NO OF BEDROOMS -->
				<div class="col-lg-4" id="bedrooms">
					<label for="bedrooms"><b class="burgundy">* </b><span class="brand-color-darker">No of Bedrooms</span></label>
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fa fa-bed"></i></div>
						</div>
						<input name="bedrooms" type="number" required class="form-control form-control-sm" id="bedrooms" size="2" maxlength="2" placeholder="No of bedrooms" value="{!! old('bedrooms') !!}" />
					</div> 
				</div>

			</div><!-- End of Form-group -->    
				
			<!-- Form-group containing STATUS, AMOUNT and RESIDENTIAL -->
			<div class="form-group row">
			
				<!-- STATUS -->
				<div class="col-lg-4">
					<div class="row">
						<div class="custom-control custom-radio col-6">
							<input id="rent" type="radio" class="custom-control-input" name="status" value="rent" required @if(!old('status') || (old('status')!='sale')) checked @endif />&nbsp;&nbsp; 
							<label class="custom-control-label" for="rent">Rent </label>
						</div>
						<div class="custom-control custom-radio col-6">
							<input id="sale" class="custom-control-input" type="radio" name="status" value="sale" required @if(old('status') && (old('status')=='sale')) checked @endif />
							<label class="custom-control-label" for="sale">Sale </label>
						</div>
					</div>
				</div>
			
				<!-- PURPOSE -->
				<div class="col-lg-4">
						<div class="row">
							<div class="custom-control custom-radio col-6">
								<input id="residential" class="custom-control-input" type="radio" name="purpose" value="residential" required @if(!old('purpose') || (old('purpose')!='commercial')) checked @endif />&nbsp;&nbsp; 
								<label class="custom-control-label" for="residential">Residential </label>
							</div>

							<div class="custom-control custom-radio col-6">
								<input id="commercial" class="custom-control-input" type="radio" name="purpose" value="commercial" required
								@if(old('purpose') && (old('purpose')=='commercial')) checked @endif/>
								<label class="custom-control-label" for="commercial">Commercial </label>
							</div>

						</div>
					</div> 
					
			</div>
			
			<div class="form-group eg">
				<label for="price"><b class="burgundy">* </b><span class="brand-color-darker">Price <small id="per-anum">(Per Annum)</small></span></label>
				<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">₦</div>
						</div>
				<input id="price" type="number" min="50000" name="price" class="form-control input-sm" required value="{!! old('price') !!}" /> 
				</div>  
				<small class="form-text burgundy">E.g: 10000 (correct) not 10,000 (incorrect)</small>
			</div>

				<div class="addhouse_container__addphoto shadow p-2 mb-3 border-radius-big">

					<h5 class=""><span class="fa fa-photo"></span> Add House Photos </h4>
					<h6 class="burgundy">Maximum Photo Size allowed is 10MB</h6>

					<div id="photo-inputs" class="">  
						<div class="col-lg-8">
							<img id="data1" class="col-sm-3 col-xs-5" />
							<span id="info1" class="col-sm-6 col-xs-7" ></span>
						</div>
						
						<div class="form-group">
							<input class="form-control photo form-control-sm" type="file" id="photo_1" data-id="data1" name="photo[]" required />
							<input class="form-control form-control-sm" type="text" name="photo_title[]" placeholder="Photo Name/Title" />
						</div> 
					</div>

					<div id="add-more" class="form-group" style="margin-bottom: 5px;">
						<button type="button" class="btn btn-primary btn-sm rounded-corner px-4">Add More Photos</button>
					</div> 
				</div>

				<div class="form-group">  
					<input class="col-12 btn btn-outline-primary rounded-corner" type="submit" name="submit" value="Submit" />
				</div>

		{!! Form::close() !!}

	</div>
</div>

@endsection

@section('js')
	@include('inc.realtor.add_photos_js')
	@include('inc.realtor.add_house_js')
@endsection