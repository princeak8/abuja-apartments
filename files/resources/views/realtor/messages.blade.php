{{-- @if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif --}}

@extends('layouts.realtor')

@section('content')

<style type="text/css">
.messages {
	display: none;
}
</style>

<div class="extra_pages">
	<h4 class="extra_pages__title">
		<span class="fa fa-envelope"></span> My Messages 
	</h4>
	<div class="extra_pages__body">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-inbox-tab" data-toggle="tab" href="#nav-inbox" role="tab" aria-controls="nav-home" aria-selected="true">Inbox</a>
				{{-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
				<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> --}}
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-inbox" role="tabpanel" aria-labelledby="nav-inbox-tab">
				@if(count($messages) == 0)
					<p>You have no messages</p>
				@else
				<div class="table-responsive mt-2">
					<table class="table table-borderless col-12">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col"></th>
								<th scope="col">Name</th>
								<th scope="col">Sent</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@php $n = 0; @endphp
							@foreach($messages as $key=>$message)
								@php $n++; @endphp

								<tr id="message-{{$message->id}}" style="@if($message->unread==1) font-weight: bold; @endif ">
									{{-- <td><input type="radio" checked /></td> --}}
									<td>{{$key}}</td>
									<td>
										<span class="fa {{$message->unread==1 ? 'fa-envelope' : 'fa-envelope-open'}}"></span>
									</td>
									
									<td>{{$message->sender->name}}</td>
									<td>{{$message->created_at->diffForHumans()}}</td>
									<td>
										<a href="{{url('realtor/message/'.$message->id)}}" class="btn btn-primary btn-sm">View</a>
										@if($message->unread==1)
											<button type="button" class="btn btn-warning btn-sm" data-id="{{$message->id}}">Mark as read</button>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endif
			</div>
			{{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div> --}}
		</div>
	</div>
	

</div>

@endsection
   
@section('js')
	<script type="application/javascript">
	$(document).ready(function(e) {
		$('#inbox').css('display', 'block');
	    $('li').click(function(e) {
		   $('.messages').css('display', 'none');
	       var id = $(this).data('id');
		   $('#'+id).css('display', 'block');
		   $('li').each(function(index, element) {
	        $(this).removeClass('active');
			$('#'+id).addClass('active');
	    });
		   
	    });

	    $(document).on('click', '.mark-read', function(e) {
            CSRF_TOKEN = $('input[name=_token]').val();
            var btn = $(this);
            var id = $(this).data('id');
            var postFields = {id: id, _token: CSRF_TOKEN};
            var postUrl = "{{url('realtor/mark_read')}}";
            $.ajax({
				url: postUrl,
				data: postFields,
				type: 'post',
				async: false,
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(errorThrown);
					$('#edit-'+id).html(value);
					$('#edit-'+id).data('id', 1);
				},
				success: function(data){
	                console.log(data.status);
					if(data.status=='success') { 
						$('#message-'+id).removeAttr('style');
						$('#message-'+id).css('background-color', '#CCC');
						btn.remove();
					}
				}
			});
	});
	</script>
@endsection