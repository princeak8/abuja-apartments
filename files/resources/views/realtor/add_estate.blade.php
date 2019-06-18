@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor')

@section('content')

<div class="col-sm-12 col-md-8 col-md-offset-2" style="border: #000 medium solid">
	<?php if(isset($_SERVER['HTTP_REFERER'])) { ?>
    	<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><h4 class="pull-right"><i class="fa fa-reply-all"></i> Back</h4></a>
	<?php } ?>

	<h4> New Estate </h4>

	<p>@include('inc.errors')</p>
	
	@if(request()->session()->exists('error'))
	    <p class="alert-danger">{{session('error')}} </p>
	@endif
	  
	<p>
		Fill the following fields below accordingly
	</p>

	<!-- estate Details Form -->
	<p><i>All Fields marked as asterics(<b class="red">*</b>) are Compulsory</i></p>
	{!! Form::open(['action' => ['Realtor\EstateController@save'], 'id'=>'add-estate-form', 'method'=>'POST',  'enctype'=>"multipart/form-data"]) !!}
		
		<div class="form-group">
    		{!! Form::label('name', 'NAME:', ['class'=>'burgundy']) !!}
    		<p style="color: red; display: none;" id="name-error"></p>
    		<div class="input-group">
      			<span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
      			{!! Form::text('name', null, ['placeholder'=>'NAME', 'id'=>'name', 'class'=>'form-control', 'value'=>old('title'), 'data-id'=>Auth::user()->id, 'required']) !!}
    		</div>  
  		</div>

  		<div class="form-group">  
    		{!! Form::label('location', 'LOCATION:', ['class'=>'burgundy']) !!}
			<div class="input-group">
      			<span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
      			<select id="location" name="location_id" class="form-control input-sm">
        			<option value="">SELECT A LOCATION</option>
            		@foreach($locations as $location)
            			<option @if(old('location_id')==$location->id) selected @endif value="{{$location->id}}"> 
            				{{$location->name}}
            			</option>
            		@endforeach
      			</select>
    		</div>
  		</div>

  		<div class="form-group">  
    		{!! Form::label('water_source', '*Water Source:', ['class'=>'burgundy']) !!}

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
    		{!! Form::label('facilities', 'Additional Estate Facilities:') !!}
    		{!! Form::text('facilities', old('facilities'), ['id'=>'facilities', 'class'=>'form-control input-sm', 'placeholder'=>'Enter each facility separated with a comma. e.g; shower, sitouts, tiles']) !!}
  		</div> 
  		
  		<div class="form-group">
    		{!! Form::label('description', 'Description:', ['class'=>'burgundy']) !!}
    		{!! Form::textarea('description', null, ['placeholder'=>'Description', 'class'=>'form-control']) !!}
  		</div>
  
  		<h4 class="no-margin"><span class="fa fa-photo"></span> Add Estate Photos </h4>
  		<h5 class="burgundy">Maximum Photo Size allowed is 10MB</h5>

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
	  
	  	<div class="clear"></div>

	  	<div id="add-more" class="form-group" style="margin-bottom: 5px;">
	    	<button type="button" class="btn btn-primary">Add More Photos</button>
	  	</div>
	  	<div class="clear"></div> 
	  
	  	<div class="form-group">  
	    	<input class="form-control btn btn-info" type="submit" name="submit" value="Submit" />
	  	</div>

@endsection

@section('js')
	@include('inc.realtor.add_photos_js')
@endsection