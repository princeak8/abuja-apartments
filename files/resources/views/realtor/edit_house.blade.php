@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor')

@section('content')

<div class="form_cont">
	<h4>
		<a class="" href="{{url('realtor/house/'.$house->id)}}">
			<i class="fa fa-reply-all"></i> {{$house->bedrooms.'-Bedroom '.$house->house_type->type}}
	    </a>
	</h4>
	<h5 class="size"><i class="fa fa-edit"></i> Edit House</h5>
	<p>@include('inc.errors')</p>
	@if(request()->session()->exists('msg'))
		<p class="@if(request()->session()->exists('status')==1) alert-success @else alert-danger @endif">
			{{session('msg')}} 
		</p>
	@endif
	{!! Form::model($house, ['action' => ['Realtor\HouseController@update'], 'method'=>'PATCH']) !!}
		<div class="form-group">
			{!! Form::label('title', 'TITLE:', ['class'=>'burgundy']) !!}
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
				{!! Form::text('title', null, ['placeholder'=>'TITLE', 'id'=>'title', 'class'=>'form-control', 'required']) !!}
			</div>
		</div> 

    @if($house->estate_id > 0)
    <div class="form-group">  
        {!! Form::label('unit', '*Number of Units:', ['class'=>'burgundy']) !!}
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-list-ul"></i></span>
            {!! Form::text('units', null, ['id'=>'unit', 'class'=>'form-control input-sm', 'required']) !!}
        </div>
      </div>
    @endif

    @if($house->estate_id == 0)
  		<div class="form-group">  
    		{!! Form::label('location', 'LOCATION:', ['class'=>'burgundy']) !!}
			<div class="input-group">
      			<span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
      			<select id="location" name="location_id" class="form-control input-sm">
        			<option value="">SELECT A LOCATION</option>
            		@foreach($locations as $location)
            			<option 
            				@if($house->location_id==$location->id || old('location_id')==$location->id) selected @endif value="{{$location->id}}"> 
            				{{$location->name}}
            			</option>
            		@endforeach
      			</select>
    		</div>
  		</div> 
    @endif
    
  		<div class="form-group">  
    		{!! Form::label('rent', 'RENT:', ['class'=>'burgundy']) !!}
    		<input id="rent" type="radio" name="status" value="rent" required @if($house->status=='rent' || (old('status')!='sale')) checked @endif />

    		{!! Form::label('sale', 'SALE:', ['class'=>'burgundy']) !!}
  			<input id="sale" type="radio" name="status" value="sale" required @if($house->status=='sale' || (old('status')=='sale')) checked @endif />
  		</div>  
  
  		<div class="form-group">
    		{!! Form::label('type', 'HOUSE TYPE:', ['class'=>'burgundy']) !!}
    		<div class="input-group">
        		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-home"></i></span>
        		<select id="type" name="house_type_id" class="form-control input-sm">
        			<option value="">SELECT HOUSE TYPE</option>
            		@foreach($house_types as $house_type) 
            			<option @if($house->house_type_id==$house_type->id) selected @endif value="{{$house_type->id}}">
            				{{$house_type->type}}
            			</option>
            		@endforeach
        		</select>
    		</div>    
  		</div> 

  		<div class="form-group">
  			<div class="col-md-3 no_pad_left no_pad_r">
      			{!! Form::label('bedrooms', 'NO OF BEDROOMS:', ['class'=>'burgundy']) !!}
      			<div class="input-group">
        			<span class="input-group-addon" id="basic-addon1"><i class="fa fa-bed"></i></span>
        			{!! Form::number('bedrooms', null, ['id'=>'bedrooms', 'class'=>'form-control input-sm', 'required', 'size'=>'2', 'maxlength'=>'2']) !!}
      			</div>  
    		</div>

    		<div class="col-md-3 no_pad_left no_pad_r">
      			{!! Form::label('bathrooms', 'NO OF BATHROOMS:', ['class'=>'burgundy']) !!}
      			<div class="input-group">
        			<span class="input-group-addon" id="basic-addon1"><i class="fa fa-bed"></i></span>
        			{!! Form::number('bathrooms', null, ['id'=>'bathrooms', 'class'=>'form-control input-sm', 'required', 'size'=>'2', 'maxlength'=>'2']) !!}
      			</div>  
    		</div>

    		<div class="col-md-3 no_pad_left no_pad_r">
      			{!! Form::label('toilets', 'NO OF TOILETS:', ['class'=>'burgundy']) !!}
      			<div class="input-group">
        			<span class="input-group-addon" id="basic-addon1"><i class="fa fa-bed"></i></span>
        			{!! Form::number('toilets', null, ['id'=>'toilets', 'class'=>'form-control input-sm', 'required', 'size'=>'2', 'maxlength'=>'2']) !!}
      			</div>  
    		</div>

    	
    		<div class="col-md-3 no_pad_left no_pad_r">
      			{!! Form::label('rooms', 'TOTAL NO OF ROOMS:', ['class'=>'burgundy']) !!}
      			<div class="input-group">
        			<span class="input-group-addon" id="basic-addon1"><i class="fa fa-bed"></i></span>
        			{!! Form::number('rooms', null, ['id'=>'rooms', 'class'=>'form-control input-sm', 'required', 'size'=>'2', 'maxlength'=>'2']) !!}
      			</div>  
    		</div>
    		<div class="clear"></div>
  		</div>  
  
  		<div class="form-group eg">
    		<div class="col-sm-4 no_pad_left no_pad_r">
      			<label for="price"><b class="burgundy">* </b>Price <small id="per-anum">(Per Annum)</small> :</label>
      			<div class="input-group">
        			<span class="input-group-addon" id="basic-addon1">₦</span>
        			{!! Form::number('price', null, ['id'=>'price', 'min'=>'50000', 'class'=>'form-control input-sm', 'required']) !!}
      			</div>  
      			<h5 class="help-block burgundy">E.g: 50000 (correct) not 50,000 (incorrect)</h5>
    		</div>
  
    		<div class="col-sm-4 no_pad_r no_pad_l">
      			<label for="agent_fee"><b class="burgundy">* </b>Agent Fee:</label>
      			{!! Form::label('agent_fee', 'Agent Fee:', ['class'=>'burgundy']) !!}
      			<div class="input-group">
        			<span class="input-group-addon" id="basic-addon1">₦</span>
        			{!! Form::number('agent_fee', null, ['id'=>'agent_fee', 'min'=>'0', 'class'=>'form-control input-sm']) !!}
      			</div>  
      			<h5 class="help-block burgundy">E.g: 10000 (correct) not 10,000 (incorrect)</h5>
    		</div>
  
    		<div class="col-sm-4 no_pad_right no_pad_l">
      			{!! Form::label('service_charge', 'Service Charge:', ['class'=>'burgundy']) !!}
      			<div class="input-group">
        			<span class="input-group-addon" id="basic-addon1">₦</span>
        			{!! Form::number('service_charge', null, ['id'=>'service_charge', 'min'=>'0', 'class'=>'form-control input-sm']) !!}
      			</div>  
      			<h5 class="help-block burgundy">E.g: 10000 (correct) not 10,000 (incorrect)</h5>
    		</div> 
    		<div class="clear"></div>
 		 </div>  
  
  		<div class="form-group">
    		{!! Form::label('residential', 'Residential:') !!}
    		<input id="residential" type="radio" name="purpose" value="residential" required @if(old('purpose')!='commercial'|| $house->purpose=='residential') checked @endif />&nbsp;&nbsp; &nbsp;&nbsp;
      		{!! Form::label('commercial', 'Commercial:') !!}
    		<input id="commercial" type="radio" name="purpose" value="commercial" required
		      @if(old('purpose')=='commercial' || $house->purpose=='commercial') checked @endif/>
  		</div>
    
  		<div class="form-group">  
    		{!! Form::label('water_source', '*Water Source:', ['class'=>'burgundy']) !!}

    		<span>Water Board</span> 
    		<input id="water_source" type="radio" name="water_source" value="Water Board" required
		      @if(old('water_source')=='Water Board' || $house->purpose=='Water Board') checked @endif/>  
    		
    		<span>Bore Hole</span> 
    		<input id="water_source" type="radio" name="water_source" value="Bore Hole" required
		      @if(old('water_source')=='Bore Hole' || $house->purpose=='Bore Hole') checked @endif/> 
    		  
    		<span>Well</span> 
    		<input id="water_source" type="radio" name="water_source" value="Well" required
		      @if(old('water_source')=='Well' || $house->purpose=='Well') checked @endif/>
    		       
    		<span>N/A</span> 
    		<input id="water_source" type="radio" name="water_source" value="N/A" required
		      @if(old('water_source')=='N/A' || $house->purpose=='N/A') checked @endif/>
  		</div>

  		<div class="form-group">
    		{!! Form::label('facilities', 'Facilities:') !!}
    		{!! Form::text('facilities', null, ['id'=>'facilities', 'class'=>'form-control input-sm', 'placeholder'=>'Enter each facility separated with a comma. e.g; shower, sitouts, tiles']) !!}
  		</div>

		<div id="s-plan" style="display:none" class="form-group">
    		{!! Form::label('sale_plan', 'House Sale Plan:', ['class'=>'burgundy']) !!}>
    		{!! Form::textarea('sale_plan', null, ['placeholder'=>'House Sale Plan', 'class'=>'form-control']) !!}
  		</div>
  		<div class="form-group">
    		{!! Form::label('description', 'Description:', ['class'=>'burgundy']) !!}
    		{!! Form::textarea('description', null, ['placeholder'=>'Description', 'class'=>'form-control']) !!}
  		</div>
   		<input type="hidden" name="house_id" value="{{$house->id}}" />
  		<div class="clear"></div> 
	  
	  	<div class="form-group">  
	    	<input class="form-control btn btn-info" type="submit" name="submit" value="Submit" />
	  	</div>

	{!! Form::close() !!}
</div>

@endsection

@section('js')
	<script type="application/javascript">
		$(document).ready(function(e) {
			var init_status = $('input[name=status]:checked').val();
			if(init_status == 'sale') {
				$('#s-plan').css('display', 'block');
		    $('#per-anum').css('display', 'none');
			}
			$(document).on('click','input[name=status]',function(e) {
				var status = $(this).val();
			   //alert(status);
			   if(status=='sale') {
				   $('#s-plan').css('display', 'block');
		       $('#per-anum').css('display', 'none');
			   }else{
				   $('#s-plan').css('display', 'none');
		       $('#per-anum').css('display', 'inline-block');
			   }
			})
		})
	</script>
@endsection