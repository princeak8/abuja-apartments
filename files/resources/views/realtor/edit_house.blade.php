{{-- @if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif --}}

@extends('layouts.realtor')

@section('content')

<div class="form_cont edithouse_container">
	<div class="edithouse_container__sub">
		<div class="edithouse_container__sub__header">
			<h4 class="edithouse_container__sub__header__title1">
				<a class="btn btn-outline-primary btn-sm" href="{{url('realtor/house/'.$house->id)}}">
					<i class="fa fa-caret-left"></i> {{$house->bedrooms.'-Bedroom '.$house->house_type->type}}
					</a>
			</h4>
			
			<h5 class="edithouse_container__sub__header__title2"><i class="fa fa-edit"></i> Edit House</h5>
			<h5 class="edithouse_container__sub__header__title3">
				<a class="btn btn-outline-primary btn-sm" href="{{url('realtor/houses')}}">Houses</a>
			</h5>
		</div>
		<p>@include('inc.errors')</p>
		@if(request()->session()->exists('msg'))
			<p class="@if(request()->session()->exists('status')==1) alert-success @else alert-danger @endif alert">
				{{session('msg')}} 
			</p>
		@endif
		{!! Form::model($house, ['action' => ['Realtor\HouseController@update'], 'method'=>'PATCH']) !!}
			<div class="form-group">
				{!! Form::label('title', 'Title') !!}
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-thumb-tack"></i></span>
					</div>
					{!! Form::text('title', null, ['placeholder'=>'TITLE', 'id'=>'title', 'class'=>'form-control form-control-sm', 'required']) !!}
				</div>
			</div> 

			@if($house->estate_id > 0)
			<div class="form-group">  
					{!! Form::label('unit', '*Number of Units:') !!}
					<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-list-ul"></i></span>
							</div>
							{!! Form::text('units', null, ['id'=>'unit', 'class'=>'form-control form-control-sm', 'required']) !!}
					</div>
				</div>
			@endif
			
			<div class="form-group row"> 
				<div class="col-lg-4">
					<div class="row mt-4 pt-2 px-4">
						<div class="custom-control custom-radio col-6"> 
							<input id="rent" type="radio" name="status" class="custom-control-input" value="rent" required @if($house->status=='rent' || (old('status')!='sale')) checked @endif />
							{!! Form::label('rent', 'Rent', ['class'=>'custom-control-label']) !!}
						</div>
						<div class="custom-control custom-radio col-6">
							<input id="sale" type="radio" name="status" class="custom-control-input" value="sale" required @if($house->status=='sale' || (old('status')=='sale')) checked @endif />
							{!! Form::label('sale', 'Sale',['class'=>'custom-control-label']) !!}
						</div>
					</div>
				</div>
				@if($house->estate_id == 0)
					<div class="col-lg-4">
						{!! Form::label('location', 'Location') !!}
						<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
								</div>
								<select id="location" name="location_id" class="form-control form-control-sm">
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
				<div class="col-lg-4">
					{!! Form::label('type', 'House Type') !!}
					<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-home"></i></span>
							</div>
							<select id="type" name="house_type_id" class="form-control form-control-sm">
								<option value="">SELECT HOUSE TYPE</option>
									@foreach($house_types as $house_type) 
										<option @if($house->house_type_id==$house_type->id) selected @endif value="{{$house_type->id}}">
											{{$house_type->type}}
										</option>
									@endforeach
							</select>
					</div>
				</div>	    
			</div> 

				<div class="form-group row">
					<div class="col-lg-3">
							<b class="burgundy">* </b>
							{!! Form::label('bedrooms', 'No of bedrooms') !!}
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-bed"></i></span>
								</div>
								{!! Form::number('bedrooms', null, ['id'=>'bedrooms', 'class'=>'form-control form-control-sm', 'required', 'size'=>'2', 'maxlength'=>'2']) !!}
							</div>  
					</div>

					<div class="col-lg-3">
							<b class="burgundy">* </b>
							{!! Form::label('bathrooms', 'No of bathrooms') !!}
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-bed"></i></span>
								</div>
								{!! Form::number('bathrooms', null, ['id'=>'bathrooms', 'class'=>'form-control form-control-sm', 'required', 'size'=>'2', 'maxlength'=>'2']) !!}
							</div>  
					</div>

					<div class="col-lg-3">
							<b class="burgundy">* </b>
							{!! Form::label('toilets', 'No of toilets') !!}
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-bed"></i></span>
								</div>
								{!! Form::number('toilets', null, ['id'=>'toilets', 'class'=>'form-control form-control-sm', 'required', 'size'=>'2', 'maxlength'=>'2']) !!}
							</div>  
					</div>

				
					<div class="col-md-3 no_pad_left no_pad_r">
							{!! Form::label('rooms', 'Total no of rooms') !!}
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-bed"></i></span>
								</div>
								{!! Form::number('rooms', null, ['id'=>'rooms', 'class'=>'form-control form-control-sm', 'size'=>'2', 'maxlength'=>'2']) !!}
							</div>  
					</div>
				</div>  
		
				<div class="form-group row">
					<div class="col-lg-4 ">
							<label for="price"><b class="burgundy">* </b>Price <small id="per-anum">(Per Annum)</small> :</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text py-0 px-3">₦</span>
								</div>
								{!! Form::number('price', null, ['id'=>'price', 'min'=>'50000', 'class'=>'form-control form-control-sm', 'required']) !!}
							</div>  
							<p class="form-text burgundy">E.g: 50000 (correct) not 50,000 (incorrect)</p>
					</div>
					<div class="col-lg-4" id="agent-fee">
							<label for="agent_fee"><b class="burgundy">* </b>Agent Fee:</label>
							{!! Form::label('agent_fee', 'Agent Fee') !!}
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text py-0 px-3">₦</span>
								</div>
								{!! Form::number('agent_fee', null, ['id'=>'agent_fee', 'min'=>'0', 'class'=>'form-control form-control-sm']) !!}
							</div>  
							<p class="form-text burgundy">E.g: 10000 (correct) not 10,000 (incorrect)</p>
					</div>
		
					<div class="col-lg-4" id="service-charge">
							{!! Form::label('service_charge', 'Service Charge') !!}
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text py-0 px-3">₦</span>
								</div>
								{!! Form::number('service_charge', null, ['id'=>'service_charge', 'min'=>'0', 'class'=>'form-control form-control-sm']) !!}
							</div>  
							<p class="form-text burgundy">E.g: 10000 (correct) not 10,000 (incorrect)</p>
					</div> 
			</div>  
		
				<div class="form-group row px-3">
					<span class="custom-control custom-radio mr-4"> 
						{!! Form::label('residential', 'Residential ') !!}
						<input id="residential" type="radio" name="purpose" value="residential" required 
						@if(old('purpose')!='commercial'|| $house->purpose=='residential') checked @endif />	
					</span>&nbsp;&nbsp;&nbsp;
					<span>
						{!! Form::label('commercial', 'Commercial') !!}
						<input id="commercial" type="radio" name="purpose" value="commercial" required
						@if(old('purpose')=='commercial' || $house->purpose=='commercial') checked @endif/>
					</span>
				</div>
			
				<div class="form-group row px-3">  
					<span class="burgundy">* </span>{!! Form::label(' water_source', '  Water Source:', ['class' => 'mr-4']) !!}
					<span class="custom-control custom-radio mr-4">
						<label>Water Board</label> 
						<input id="water_source" type="radio" name="water_source" value="Water Board" required
						@if(old('water_source')=='Water Board' || $house->purpose=='Water Board') checked @endif/>
					</span>  
					
					<span class="custom-control custom-radio mr-4">
						<label>Bore Hole</label> 
						<input id="water_source" type="radio" name="water_source" value="Bore Hole" required
							@if(old('water_source')=='Bore Hole' || $house->purpose=='Bore Hole') checked @endif/> 
					</span>

					<span class="custom-control custom-radio mr-4">
						<label>Well</label> 
						<input id="water_source" type="radio" name="water_source" value="Well" required
							@if(old('water_source')=='Well' || $house->purpose=='Well') checked @endif/>
					</span>
					
					<span class="custom-control custom-radio">
						<label>N/A</label> 
						<input id="water_source" type="radio" name="water_source" value="N/A" required
							@if(old('water_source')=='N/A' || $house->purpose=='N/A') checked @endif/>
					</span>
				</div>

				<div class="form-group">
					{!! Form::label('facilities', 'Facilities') !!}
					{!! Form::text('facilities', null, ['id'=>'facilities', 'class'=>'form-control form-control-sm', 'placeholder'=>'Enter each facility separated with a comma. e.g; shower, sitouts, tiles']) !!}
				</div>

			<div id="s-plan" style="display:none" class="form-group">
					{!! Form::label('sale_plan', 'House Sale Plan') !!}
					{!! Form::textarea('sale_plan', null, ['placeholder'=>'House Sale Plan', 'class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('description', 'Description') !!}
					{!! Form::textarea('description', null, ['placeholder'=>'Description', 'class'=>'form-control']) !!}
				</div>
				<input type="hidden" name="house_id" value="{{$house->id}}" /> 
			
				<div class="form-group">  
					<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Submit" />
				</div>

		{!! Form::close() !!}
	</div>
</div>

@endsection

@section('js')
	<script type="application/javascript">
		$(document).ready(function(e) {
			var init_status = $('input[name=status]:checked').val();
			if(init_status == 'sale') {
				$('#s-plan').css('display', 'block');
		    	$('#per-anum').css('display', 'none');
				$('#agent-fee').css('display', 'none');
				$('#service-charge').css('display', 'none');
			}
			$(document).on('click','input[name=status]',function(e) {
				var status = $(this).val();
			   //alert(status);
			   if(status=='sale') {
				   	$('#s-plan').css('display', 'block');
		       		$('#per-anum').css('display', 'none');
					$('#agent-fee').css('display', 'none');
					$('#service-charge').css('display', 'none');
			   }else{
				   	$('#s-plan').css('display', 'none');
			       	$('#per-anum').css('display', 'inline-block');
				   	$('#agent-fee').css('display', 'block');
					$('#service-charge').css('display', 'block');
			   }
			})
		})
	</script>
@endsection