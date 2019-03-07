@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor')

@section('content')

<div class="request_cont">
    <h3><i class="fa fa-question-circle"></i> My Requests<i class="fa fa-caret-down"></i> </h3>
    	@include('inc.errors')

    <div class="request1">

        <h4><span class="fa fa-bullseye"></span> Circle Requests</h4>
        
        <div class="requests col-sm-12">
        <h5>Awaiting Approval</h5>
        	@if(request()->session()->exists('error'))
	           	<p class="alert-danger">{{session('circle_success')}} </p>
	        @endif
	        @if(request()->session()->exists('error'))
	            <p class="alert-danger">{{session('circle_error')}} </p>
	        @endif

           	@if(Auth::user()->circle_requests()->count()==0)
           		<p>There Are No Circle Requests awaiting your approval</p>
           	@else
	            <table class="table table-responsive table-striped">
	                <thead>
	                    <th>S/N</th>
	                    <th>Realtor Name</th>
	                    <th>Date Sent</th>
	                    <th>Action</th>
	                </thead>
	                <tbody class="bg_white">
	                <?php $n = 0; ?> 
	                    @foreach(Auth::user()->circle_requests() as $request) <?php $n++; ?>
	                    	@if($request->user_one==Auth::user()->id)
	                    		<?php $requester = $request->user_two; ?>
	                    	@else
	                    		<?php $requester = $request->user_one; ?>
	                    	@endif
	                    <tr>
	                        <td>{{$n}}</td>
	                        <td>{{\App\Realtor::find($requester)->full_name}}</td>
	                        <td>{{$request->created_at}}</td>
	                        <td>
	                            {!! Form::open(['action' => ['CircleController@process_request'], 'method'=>'POST', 'style'=>"display:inline-block"]) !!}
	                                <input type="hidden" name="circle_id" value="{{$request->id}}" />
	                                <input type="hidden" name="id" value="{{$request->action_user}}" />
	                                <input type="hidden" name="action" value="accept" />
	                                <input class="no_bor btn-success" type="submit" name="submit" value="Accept" />
	                            {!! Form::close() !!}
	                            {!! Form::open(['action' => ['CircleController@process_request'], 'method'=>'POST',  'style'=>"display:inline-block"]) !!}
	                                <input type="hidden" name="circle_id" value="{{$request->id}}" />
	                                <input type="hidden" name="id" value="{{$request->action_user}}" />
	                                <input type="hidden" name="action" value="decline" />
	                                <input class="no_bor btn-danger" type="submit" name="submit" value="Decline" />
	                            {!! Form::close() !!}
	                        </td>
	                    </tr>
                		@endforeach
             		</tbody>
            	</table>
            @endif

        </div>
        <div class="clear"></div>    
    </div>    

    <div class="request1">    
        <h4><i class="fa fa-square"></i> Pending Circle Requests</h4>
        <div class="requests col-sm-12">
            
            @if(Auth::user()->sent_requests()->count()==0)
            	<p>There Are No Pending Requests</p> 
            @else
	            <table class="table table-responsive table-striped">
	                <thead>
	                    <th>S/N</th>
	                    <th>Realtor Name</th>
	                    <th>Date Sent</th>
	                    <th>Status</th>
	                    <th>Action</th>
	                </thead>
	                <tbody class="bg_white">
	                {{-- $n = 0 --}}
	                    @foreach(Auth::user()->sent_requests() as $request) {{-- $n++ --}}
	                        @if($request->user_one==Auth::user()->id)
	                    		{{-- $accepter = $request->user_two --}}
	                    	@else
	                    		{{-- $accepter = $request->user_one --}}
	                    	@endif
	                ?>
		                    <tr>
		                        <td>{{$n}}</td>
		                        <td>{{$accepter->full_name}}</td>
		                        <td>{{date('jS M Y', $request->created_at)}}</td>
		                        <td>
		    						@if($request->action==0) 
		    							Pending 
		    						@elseif($request->action==-1) 
		    							Declined 
		    						@endif
		    						?>
		                        </td>
		                        <td>
		                        	@if($request->action==-1) 
		                              <form action="../../processes/send_circle_request.php" method="post" style="display:inline-block">
		                                    <input type="hidden" name="circle_id" value="{{$request->id}}" />
		                                    <input class="no_bor btn-warning" type="submit" name="submit" value="Resend Request" />
		                                </form>
		                            @endif
		                        	
		                            <form name="cancel" action="../../processes/process_request.php" method="post" style="display:inline-block">
		                                <input type="hidden" name="circle_id" value="{{$request->id}}" />
		                                <input type="hidden" name="request_type" value="circle" />
		                                <input class="no_bor btn-danger" type="submit" name="submit" value="Cancel" />
		                            </form>
		                         </td>
		                    </tr>
	                	@endforeach
	              </tbody>
	           	</table>
            @endif
        </div>
          <div class="clear"></div> 
    </div>

    <div class="request1" >

        <h4><span class="fa fa-share-square"></span> House Sharing Requests</h4>
        
        
        <div class="requests col-sm-12">
            <h5>Awaiting Approval</h5>
            
            @if(Auth::user()->share_requests()->count()==0) 
           		<p>There Are No Requests awaiting your approval</p>
           	@else
	            <table class="table table-responsive table-striped">    
	                <thead>
	                    <th>S/N</th>
	                    <th>Realtor Name</th>
	                    <th>House</th>
	                    <th>Date Sent</th>
	                    <th>Action</th>
	                </thead>
	                <tbody class="bg_white">
	                {{-- $n = 0 --}}
	                    @foreach(Auth::user()->share_requests() as $request) {{-- $n++ --}}
		                    <tr>
		                        <td>{{$n}}</td>
		                        <td>{{$request->sharer->full_name}}</td>
		                        <td>
		    						{{$request->house->title}}<br/>
		                        	<a href="index.php?page=view house&house_id={{$request->house->house_id}}" target="_blank">	
		                        		View House
		                        	</a>
		                        </td>
		                        <td>{{date('jS M Y', $request->created_at)}}</td>
		                        <td>
		                            <form action="../../processes/process_request.php" method="post" style="display:inline-block">
		                               <input type="hidden" name="realtor_house_id" value="{{$request->id}}" />
		                                <input type="hidden" name="request_type" value="sharing" />
		                                <input class="no_bor btn-success" type="submit" name="submit" value="Accept" />
		                            </form>
		                            <form action="../../processes/process_request.php" method="post" style="display:inline-block">
		                              <input type="hidden" name="realtor_house_id" value="{{$request->id}}" />
		                                <input type="hidden" name="request_type" value="sharing" />
		                                <input class="no_bor btn-danger" type="submit" name="submit" value="Decline" />
		                            </form>
		                        </td>
		                    </tr>
	                	@endforeach
	              </tbody>
	            
	            </table>
            @endif
        </div>
         <div class="clear"></div>    
    </div>
</div><!-- request_cont ends -->

@endsection

@section('js')
<script type="application/javascript">
 $('form[name=cancel]').submit(function(e) {
    return confirm('Are you sure you want to cancel this request?');
});
</script> 
@endsection