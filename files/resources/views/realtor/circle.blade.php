@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor')

@section('content')

<div class="circle_cont">
	<h3><i class="fa fa-bullseye"></i> My Circles <i class="fa fa-caret-down"></i></h3>
	
	<div class="circle1 table-responsive">
		<table class="table table-responsive table-striped">
   			@if(empty($circle)) <span class='size'>There are no realtors in your circle</span> @else
		   		<thead>
		        	<th>S/N</th>
		            <th><span class="fa fa-image"></span> Photo</th>
		            <th>Realtor</th>
		            <th>Profile Name</th>
		            <th>Action</th>
		        </thead>
        		<tbody>
        			@php $n = 0; @endphp

					@foreach($circle as $rship) 
						@php $n++; @endphp
						@if($rship->user_one == Auth::user()->id)
							@php $realtor = $rship->userTwo; @endphp
						@else
							@php $realtor = $rship->userOne; @endphp
						@endif

        				<tr>
            				<td>{{$n}}</td>
               				<td>
               	   				<img class="img-rounded" src="{{env('APP_STORAGE')}}images/profile_photos/@if(empty($realtor->profile_photo))no_photo.jpg @else{{$realtor->profile_photo}} @endif" width="100" height="70" />
               				</td>
                			<td>
                  				<a href="{{url($realtor->profile_name)}}" target="blank">
                    				{{$realtor->name}}
                  				</a>
                			</td>
                			<td><?php echo $realtor->profile_name; ?></td>
                			<td>
                				{!! Form::open(['action' => ['Realtor\CircleController@delete'], 'method'=>'POST',  'style'=>"display:inline-block"]) !!}
                    				<input type="hidden" name="circle_id" value="{{$rship->id}}" />
                         			<input type="hidden" name="realtor_id" value="{{$realtor->id}}" />
                      				<button class="no_bor btn-success" type="submit" name="submit" value="Remove From Circle" ><i class="fa fa-close"></i> Remove From Circle</button>
                        			<!--<input class="btn-success" type="submit" name="submit" value="Remove From Circle" />-->
                    			{!! Form::close() !!}
                			</td>
            			</tr>
        			@endforeach
      			</tbody>
   			@endif
    	</table>
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