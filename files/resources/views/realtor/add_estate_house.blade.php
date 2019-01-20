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

	<h3>{{$estate->name}}</h3>

	<h4> New House </h4>

	<p>@include('inc.errors')</p>

	  
	{!! Form::open(['action' => ['Realtor\EstateController@save_house'], 'method'=>'POST',  'enctype'=>"multipart/form-data"]) !!}
	   
	  <!-- Form Field for the TITLE -->
	  	<div class="form-group">
		    <label for="name"><b class="burgundy">* </b>Title or Address:</label>
		    <div class="input-group">
		      	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
				<input id="name" type="text" name="title" class="form-control input-sm" required placeholder="Title OR Adress" value="{!! old('title') !!}" />
		    </div>
		</div>


	     <!-- Form-group containing three form fields LOCATION, HOUSE TYPE and NO OF BEDROOMS -->   
	    <div class="form-group no-padding">

	    	<!--LOCATION OF HOUSE-->
	      	<input type="hidden" name="location_id" value="{{$estate->location_id}}" />

	      	<!-- HOUSE TYPE -->
		    <div class="col-md-4 no_pad_left no_pad_l no_pad_r">
			    <label for="type"><b class="burgundy">* </b>Type:</label>
		        <div class="input-group">
		          	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-home"></i></span>
		  	      	<select id="type" name="house_type_id" class="form-control input-sm" required >
		  	      		<option value="">SELECT HOUSE TYPE</option>
		  	          	@foreach($house_types as $house_type)
			  	          	<option @if(old('house_type_id') && (old('house_type_id')==$house_type->id)) selected @endif value="{{$house_type->id}}">
			  	          			{{$house_type->type}}
			  	          	</option>
		  	          	@endforeach
		  	      	</select>
		        </div>
			</div>

	      	<!-- NO OF BEDROOMS -->
		    <div class="col-md-4 no_pad_right no_pad_l" id="bedrooms">
		        <label for="bedrooms"><b class="burgundy">* </b>No of Bedrooms:</label>
		        <div class="input-group">
		           	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-bed"></i></span>
		            <input name="bedrooms" type="number" required class="form-control input-sm" id="bedrooms" size="2" maxlength="2" placeholder="No of bedrooms" value="{!! old('bedrooms') !!}" />
		        </div> 
		    </div>
		    <div class="clear"></div>

	  	</div><!-- End of Form-group -->    

	  	<!-- Form-group containing STATUS, AMOUNT and RESIDENTIAL -->
	  	<div class="form-group">
		    
		    <!-- STATUS -->
		    <div class="col-md-4 no_pad_left">
		      	<label for="rent">Rent: </label>
		      	<input id="rent" type="radio" name="status" value="rent" required @if(old('status') && (old('status')=='rent')) checked @endif />&nbsp;&nbsp; 
		      	
		      	<label for="sale">Sale: </label>
		      	<input id="sale" type="radio" name="status" value="sale" required @if(!old('status') || (old('status')!='rent')) checked @endif />
		    </div>

		    <!-- Units of House -->
		    <div class="form-group" id="units">
			    <label for="unit"><b class="burgundy">* </b>Number of Units:</label>
			    <div class="input-group">
			      	<span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
					<input id="unit" type="text" name="units" class="form-control input-sm" required placeholder="Number of Units" value="{!! old('units') !!}" />
			    </div>
			</div>

	    
		    <!-- PURPOSE -->
		    <div class="col-md-4 no_pad_l">
		      <label for="residential">Residential: </label>
		      <input id="residential" type="radio" name="purpose" value="residential" required @if(!old('purpose') || (old('purpose')!='commercial')) checked @endif />&nbsp;&nbsp; 
		      
		      <label for="commercial">Commercial: </label>
		      <input id="commercial" type="radio" name="purpose" value="commercial" required
		      @if(old('purpose') && (old('purpose')=='commercial')) checked @endif/>
		    </div>
	    	<div class="clear"></div> 
	  	</div>
	      
	  	<div class="form-group eg">
	    	<label for="price"><b class="burgundy">* </b>Price <small id="per-anum">(Per Annum)</small>:</label>
		    <div class="input-group">
		      <span class="input-group-addon" id="basic-addon1">₦</span>
		      <input id="price" type="number" min="50000" name="price" class="form-control input-sm" required value="{!! old('price') !!}" /> 
		    </div>  
	    	<h5 class="help-block burgundy">E.g: 10000 (correct) not 10,000 (incorrect)</h5>
	  	</div>

	  	<hr/>
		<h4 class="no-margin"><span class="fa fa-photo"></span> Add House Photos </h4>
	  	<h5 class="burgundy">Maximum Photo Size allowed is 2MB</h5>

	  	<div id="photo-inputs" class="">  
	  		<div class="col-sm-8 col-xs-12 no-padding">
		      <img id="data1" class="col-sm-3 col-xs-5 no_pad_left" />
		      <span id="info1" class="no_pad_left col-sm-6 col-xs-7" ></span>
		    </div>
		    <div class="clear"></div>
		    
		    <div class="form-group">
		       <input class="form-control photo" type="file" id="photo_1" data-id="data1" name="photo1" required />
		       <input class="form-control" type="text" name="title1" placeholder="Photo Name/Title" />
		    </div> 
	  	</div>
	  
	  	<div class="clear"></div>

	  	<div id="add-more" class="form-group" style="margin-bottom: 5px;">
	    	<button type="button" class="btn btn-primary">Add More Photos</button>
	  	</div>
	  	<div class="clear"></div> 
	  
	  	<div class="form-group">  
	    	<input type="hidden" name="estate_id" value="{{$estate->id}}" />
	    	<input class="form-control btn btn-info" type="submit" name="submit" value="Submit" />
	  	</div>


	</form>
</div>

@endsection

@section('js')
	@include('inc.realtor.add_photos_js')
	@include('inc.realtor.add_house_js')
@endsection