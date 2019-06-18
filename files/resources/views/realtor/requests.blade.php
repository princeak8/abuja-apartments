{{-- @if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif --}}

@extends('layouts.realtor')

@section('content')

<div class="extra_pages">
    <h4 class="extra_pages__title"><i class="fa fa-question-circle"></i> My Requests </h4>
    @include('inc.errors')
	<div class="extra_pages__body">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="circle-tab" data-toggle="tab" href="#circle" role="tab" aria-controls="circle" aria-selected="true">
				<span class="fa fa-bullseye"></span> Circle Requests</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">
				<i class="fa fa-square"></i> Pending Circle Requests</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="hse_sharing-tab" data-toggle="tab" href="#hse_sharing" role="tab" aria-controls="hse_sharing" aria-selected="false">
				<span class="fa fa-share-square"></span> House Sharing Requests</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="circle" role="tabpanel" aria-labelledby="circle-tab">
				@include('inc.realtor.requests.circle_request')
			</div>
			<div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
				@include('inc.realtor.requests.pending_request')
			</div>
			<div class="tab-pane fade" id="hse_sharing" role="tabpanel" aria-labelledby="hse_sharing-tab">
				@include('inc.realtor.requests.hse_sharing')
			</div>
		</div>
		
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