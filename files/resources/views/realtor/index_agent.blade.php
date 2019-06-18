{{-- @include('inc.realtor.agent_head_links') --}}

@extends('layouts.realtor')

@section('content')

<div id="main-content" class="content__right__main">
		
		<div class="content__right__main__head">
			{{-- <h3 class="content__right__main__head__title">Agent's Page</h3> --}}
			<p class="content__right__main__head__p">
				<span>IMPORTANT:</span> 
						Your Personalized Page is 
				<a href="https://www.abujaapartments.com.ng/{{$realtor->profile_name}}" target="_blank">
						https://www.abujaapartments.com.ng/{{$realtor->profile_name}}
				</a>&nbsp; 
							Use this url to advertise your house portfolio to prospective Clients
			</p>
		</div> 
		<div class="content__right__main__houses">
			@include('inc.realtor.houses')
		</div>
		
</div>

@endsection