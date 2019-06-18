@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor')

@section('content')

<h4>Message</h4>

	<strong>FROM: <i>{{$message->sender->name}}</i></strong>
    <br/>
    @if(!empty($message->related)) 
    	<strong>RELATED TO: 
    		<a href="{{url($message->related.'/'.$message->relatedTo->id)}}" style="color:pink">
    			<i>{{$message->relatedTo->title}}</i>
    		</a></strong>
    @endif
    <p>
    	{{$message->message}}
    </p>
    
    <hr/>
    
    <div>
    <h5>Sender Details</h5>
    @if(empty($message->sender_id) || $message->sender_id < 1) 
        <p>
			<b>Phone Number:</b> {{$message->phone}}<br/>
            <b>Email:</b> {{$Message->email}} <br/>        
        </p>
  	@else
        <p>
            <b>Phone Number:</b> @foreach($message->sender->phones as $phone) {{$phone->phone}},  @endforeach<br/>
            <b>Email:</b> {{$message->sender->email}}<br/>        
        </p>
  	@endif
    </div>

@endsection
 