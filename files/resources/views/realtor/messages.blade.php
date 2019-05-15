@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor')

@section('content')

<style type="text/css">
.messages {
	display: none;
}
</style>

<div class="circle_cont">
	<h3><span class="fa fa-envelope"></span> My Messages <i class="fa fa-caret-down"></i></h3>
	
	<div class="test">
		<ul class="nav nav-tabs">
  			<li class="active" data-id="inbox"><a href="javascript:void(0)">Inbox</a></li>
  			<!--<li data-id="sent"><a href="javascript:void(0)">Sent Messages</a></li>-->
		</ul>
	</div>

	<div id="inbox" class="messages circle1 table-responsive">
		<table class="table table-responsive">
   		 @if(count($messages) == 0)
   		 	<p>You have no messages</p>
   		 @else
	   		<thead>
	        	<th></th>
	        	<th>S/N</th>
	            <th>Name</th>
	            <th>Sent</th>
	            <th>Action</th>
	        </thead>
        	<tbody class="bg_white">
        		@php $n = 0; @endphp
				@foreach($messages as $key=>$message)
					@php $n++; @endphp

					<tr id="message-{{$message->id}}" style="@if($message->unread==1) font-weight: bold; @endif background-color:#CCC;">
						<td><input type="radio" checked /></td>
                        <td>{{$key}}</td>
                        <td>{{$message->sender->name}}</td>
                        <td>{{$message->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="{{url('realtor/message/'.$message->id)}}" class="btn btn-primary">VIEW</a>
                            @if($message->unread==1)
                                <button type="button" class="btn btn-warning mark-read" data-id="{{$message->id}}">MARK AS READ</button>
                            @endif
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