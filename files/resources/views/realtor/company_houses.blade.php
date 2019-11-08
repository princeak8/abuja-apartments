{{-- @include('inc.realtor.company_head_links') --}}

@extends('layouts.realtor')

@section('content')

<div id="main-content" class="content__right__main">
		
		<div class="content__right__main__head">
			{{-- <h3 class="content__right__main__head__title">Agent's Page</h3> --}}
			@if(empty($realtor->profile_photo) || empty($realtor->sec_question) || empty($realtor->sec_answer))
				<p class="alert alert-danger mb-2" style="background-color: pink">
					Your Profile is incomplete..
					@if(empty($realtor->profile_photo)) Upload your profile picture or logo, @endif
					@if(empty($realtor->sec_question)) secret question and answer @endif 
					<span class="">Click <a href="{{url('realtor/profile')}}">Here</a> to update your profile</span>
				</p>
			@endif
			<p class="content__right__main__head__p">
				 
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