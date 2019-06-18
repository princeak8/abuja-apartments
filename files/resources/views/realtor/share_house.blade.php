@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor')

@section('content')

<div class="col-sm-4 col-xs-12 share1">
	<h4><i class="fa fa-share-square-o"></i> Share This House Within your Circle</h4>

	<div class="img_sh">	
	    <img id="{{$mainPhoto->id}}" class="house-img" src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/{{$mainPhoto->photo}}" width="200" height="150" /><br/>
	  </div>
	  <p><?php echo $house->title; ?></p>
</div>

<div class="col-sm-8 col-xs-12 share2">
  <h5 class="text-center size no-margin"><i class="fa fa-bullseye"></i> My Circle</h5>

  <?php if(isset($_SERVER['HTTP_REFERER'])) { ?>
  <h4 class="pull-left"><a class="white" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
  	<i class="fa fa-reply"></i> Back</a>
  </h4>
  <?php } ?>

  <p class="text-center">
    Choose Realtors to share this house with
  </p>
  	@include('inc.errors')

  	@if(request()->session()->exists('success'))
		<p class="alert-success">{{session('success')}} </p>
	@endif
	@if(request()->session()->exists('error'))
		<p class="alert-danger">
			House could not be shared with; 
			@foreach(session('error') as $biz_name) 
				{{$biz_name}}, 
			@endforeach
		</p>
	@endif
	@if($realtor_circle->count()==0)
		<p style="font-size:12px">
			You have no realtor in your circle<br/> Use the "Search Realtor" input to search and add
			realtor(s) to your circle to share house with
		</p>
	@else
		{!! Form::open(['url' => 'realtor/share_house', 'method'=>'post']) !!}
			<table class="table table-responsive table-condensed table-striped">
	   		  	<thead>
	        	  	<th class="col-sm-1">S/N</th>
	            	<th class="col-sm-4"><i class="fa fa-image"></i> Photo</th>
	            	<th>Realtor Name</th>
	            	<th><i class="fa fa-share"></i> Share</th>
	       	 	</thead>
	        	<tbody>
		        	<?php $n = 0; ?>
		  			@foreach($realtor_circle as $circle) <?php $n++; ?>
		  				@if($circle->user_one==$realtor->id) 
		  					<?php $friend = $circle->userTwo; ?>
		  				@else
		  					<?php $friend = $circle->userOne; ?>
		  				@endif
		  				<?php //dd($friend); ?>
			        	<tr>
			            	 <td class="col-sm-1">{{$n}}</td>
			               <td class="col-sm-4">
			               	   <img class="img-rounded" src="{{env('APP_STORAGE')}}images/profile_photos/{{$friend->profile_photo}}" width="90" height="80" />
			               </td>
			                <td>{{$friend->biz_name}}</td>
			                <td>
				                @if($realtor->is_shared_with_realtor($friend->id))
				                    	Shared
				                @else
				                	<input type="checkbox" name="share[]" value="{{$friend->id}}" />
				                @endif
			                </td>
			            </tr>
		        	@endforeach
	      		</tbody>
	      	</table>
	      	<input type="hidden" name="house_id" value="{{$house->id}}" />
		    <input type="hidden" name="sharer_id" value="{{Auth::user()->id}}" />
		    <button class="btn btn-warning" type="submit" name="submit" value="Share"><i class="fa fa-share"></i> Share</button>
		{!! Form::close() !!}
	@endif
</div>

@endsection

@section('js')

@endsection