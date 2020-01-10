<div id="left-menu" class="col-12">
	<ul class="profileHeading">
		@if(Auth::user()->activated = 1) 
			<li><a href="{{url('realtor/home')}}">Admin Home</a></li>
		@else
			<li><a href="{{url('index')}}">Home</a></li>
		@endif
		<li @if($page=='profile') class="active_new" @endif >
			<a href="{{url('realtor/profile')}}" @if($page=='profile') class="red" @endif >My Profile</a>
		</li>
		<li @if($page=='email') class="active_new" @endif >
			<a href="{{url('realtor/change_email')}}" @if($page=='email') class="red" @endif >
				Change Email
			</a>
		</li>
		<li @if($page=='email') class="active_new" @endif >
			<a href="{{url('realtor/change_password')}}" @if($page=='password') class="red" @endif >
				Change Password
			</a>
		</li>
		<li @if($page=='secret question') class="active_new" @endif >
			<a href="{{url('realtor/change_secret_question')}}" @if($page=='secret question') class="red" @endif >
				Change Secret Question
			</a>
		</li>
		<li @if($page=='secret answer') class="active_new" @endif >
			<a href="{{url('realtor/change_secret_answer')}}" @if($page=='secret question') class="red" @endif >
				Change Secret Answer
			</a>
		</li>
		<li @if($page=='profile photo') class="active_new" @endif >
			<a href="{{url('realtor/change_profile_photo')}}" @if($page=='profile photo') class="red" @endif >
				Change Profile Photo
			</a>
		</li>
		<li @if($page=='about') class="active_new" @endif >
			<a href="{{url('realtor/edit_about')}}" @if($page=='about') class="red" @endif >
				About {{Auth::user()->name}}
			</a>
		</li>
	</ul>
</div>