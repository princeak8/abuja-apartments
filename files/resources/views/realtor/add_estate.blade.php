{{-- @if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif --}}

@extends('layouts.realtor')

@section('content')

<div id="main-content" class="content__right__main px-2">
	<div class="content__right__main__estate border-radius-big shadow px-4 py-2">
		<div class="content__right__main__estate__title py-2">
			<?php if(isset($_SERVER['HTTP_REFERER'])) { ?>
				<h4>
					<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fa fa-caret-left"></i> Back</a>
				</h4>
			<?php } ?>

			<h3> New Estate </h3>
		</div>
		<div class="">
			
				@include('inc.errors')
				
				@if(request()->session()->exists('error'))
					<p class="alert alert-danger py-2">{{session('error')}} </p>
				@endif
			
				<!-- estate Details Form -->
				<p class="alert alert-warning py-1">All Fields marked as asterics(<b class="red">*</b>) are Compulsory</p>
				{!! Form::open(['action' => ['Realtor\EstateController@save'], 'id'=>'add-estate-form', 'method'=>'POST',  'enctype'=>"multipart/form-data"]) !!}
				<div class="row">
					<div class="form-group col-lg-6">
						{!! Form::label('name', 'Name', ['class'=>'brand-color-darker']) !!}
						<p style="color: red; display: none;" id="name-error"></p>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
							{!! Form::text('name', null, ['placeholder'=>'Name', 'id'=>'name', 'class'=>'form-control form-control-sm', 'value'=>old('title'), 'data-id'=>Auth::user()->id, 'required']) !!}
						</div>  
					</div>

					<div class="form-group col-lg-6">  
						{!! Form::label('location', 'Location', ['class'=>'brand-color-darker']) !!}
						
						<select id="location" name="location_id" class="form-control form-control-sm">
							<option value="">Select a location</option>
							@foreach($locations as $location)
								<option @if(old('location_id')==$location->id) selected @endif value="{{$location->id}}"> 
									{{$location->name}}
								</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">  
					{!! Form::label('water_source', '* Water Source:', ['class'=>'brand-color-darker']) !!}

					<span>Water Board</span> 
					<input id="water_source" type="radio" name="water_source" value="Water Board" required
					@if(old('water_source')=='Water Board') checked @endif/>  
					
					<span>Bore Hole</span> 
					<input id="water_source" type="radio" name="water_source" value="Bore Hole" required
					@if(old('water_source')=='Bore Hole') checked @endif/> 
					
					<span>Well</span> 
					<input id="water_source" type="radio" name="water_source" value="Well" required
					@if(old('water_source')=='Well') checked @endif/>
						
					<span>N/A</span> 
					<input id="water_source" type="radio" name="water_source" value="N/A" required
					@if(!old('water_source') || old('water_source')=='N/A') checked @endif/>
				</div>
				
				<div class="form-group">
					{!! Form::label('facilities', 'Additional Estate Facilities') !!}
					{!! Form::text('facilities', old('facilities'), ['id'=>'facilities', 'class'=>'form-control form-control-sm', 'placeholder'=>'Enter each facility separated with a comma. e.g; shower, sitouts, tiles']) !!}
				</div> 
				
				<div class="form-group">
					{!! Form::label('description', 'Description', ['class'=>'brand-color-darker']) !!}
					{!! Form::textarea('description', null, ['placeholder'=>'Description', 'class'=>'form-control']) !!}
				</div>
				<div class="shadow border-radius-big p-2 mb-3">
					<h5>Add Estate Photos </h5>
					<h6 class="burgundy">Maximum Photo Size allowed is 10MB</h6>

					<div id="photo-inputs" class="">  
						<div class="col-sm-8 col-xs-12 no-padding">
						<img id="data1" class="col-sm-3 col-xs-5 no_pad_left" />
						<span id="info1" class="no_pad_left col-sm-6 col-xs-7" ></span>
						</div>
						<div class="clear"></div>
						
						<div class="form-group">
						<input class="form-control photo" type="file" id="photo_1" data-id="data1" name="photo[]" required />
						<input class="form-control" type="text" name="photo_title[]" placeholder="Photo Name/Title" />
						</div> 
					</div>

					<div id="add-more" class="form-group" style="margin-bottom: 5px;">
						<button type="button" class="btn btn-primary rounded-corner btn-sm px-4">Add More Photos</button>
					</div>
				
				</div>

				<div class="form-group">  
					<input class="btn btn-outline-primary col-12 rounded-corner" type="submit" name="submit" value="Submit" />
				</div>
			

		</div>

	</div>
</div>
@endsection

@section('js')
	@include('inc.realtor.add_photos_js')
@endsection