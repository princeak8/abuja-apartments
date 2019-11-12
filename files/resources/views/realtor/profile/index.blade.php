@extends('layouts.realtor_profile', ['page'=>'profile'])

@section('content')


	        <h3>MY PROFILE <i class="fa fa-caret-down"></i></h3>
	        <div class="col-sm-4">
	        	<img class="img-responsive img-thumbnail" src="{{env('APP_STORAGE')}}images/profile_photos/{{Auth::user()->profile_photo}}" width="150" height="100" />
            </div>
	        <div class="col-sm-12 table-responsive no_pad_prof">
		        <table class="table table-responsive">
		            <tr>
                        <td class="col1"><i class="fa fa-pencil-square-o"></i> 
                            @if(Auth::user()->type!='company') Firstname: @else Company/Business Name: @endif
                        </td>
                        <td id="edit-firstname" data-id="1" data-req="1">
                            {{Auth::user()->firstname}}
                        </td>
                        <td><a id="firstname" class="edit" data-title="firstname" href="javascript:void(0)"><i class="fa fa-edit"></i> Edit</a></td>
                    </tr>
                    @if(Auth::user()->type!='company')
                        <tr>
                            <td class="col1"><i class="fa fa-pencil-square-o"></i> Lastname:</td>
                            <td id="edit-lastname" data-id="1" data-req="1">{{Auth::user()->lastname}}</td>
                            <td><a id="lastname" class="edit" data-title="lastname" href="javascript:void(0)"><i class="fa fa-edit"></i> Edit</a></td>
                        </tr>
		            @endif
		            <tr>
		            	<td class="col1"><i class="fa fa-pencil-square-o"></i>  Profile Name:</td>
		                <td id="edit-profilename" data-id="1" data-req="1">{{Auth::user()->profile_name}}</td>
	                    <td><a id="profilename" class="edit" data-title="profile_name" href="javascript:void(0)"><i class="fa fa-edit"></i> Edit</a></td>
	                </tr>
		            <tr>
		            	<td class="col1"><i class="fa fa-map-marker"></i> Address:</td>
		                <td id="edit-address" data-id="1" data-req="0">{{Auth::user()->address}}</td>
		                <td><a id="address" class="edit" data-title="address" href="javascript:void(0)"><i class="fa fa-edit"></i> Edit</a></td>
	                </tr>
	                 <tr>
		                <td class="col1"><i class="fa fa-map-marker"></i> Twitter Handle:</td>
		                <td id="edit-twitter" data-id="1" data-req="0">{{Auth::user()->twitter}}</td>
		                <td><a id="twitter" class="edit" data-title="twitter" href="javascript:void(0)"><i class="fa fa-edit"></i> Edit</a></td>
		            </tr>
		            <tr>
		                <td class="col1"><i class="fa fa-phone-square"></i> Phone Number(s):</td>
		                <td>
		                    @foreach(Auth::user()->phones as $realtorPhone) 
		                        <i id="error-phone-{{$realtorPhone->id}}" class="red"></i>
		                                
								<span id="edit-phone-{{$realtorPhone->id}}" data-id="1">
									{{$realtorPhone->phone}} 
		                        </span>
		                        <a id="phone-{{$realtorPhone->id}}" class="editphone" data-title="{{$realtorPhone->id}}" data-req="0"  href="javascript:void(0)" style="margin-left:0.2em;"><i class="fa fa-edit"></i> 
		                 	        Edit
		                        </a>&nbsp;&nbsp;&nbsp;
		                            
		                    @endforeach
		                </td>
		            </tr>
		                
		        </table>
		    </div>
	    

@endsection

@section('js')
    <script type="application/javascript">
	    //$(document).ready(function(e) { alert('working');
        //})
</script>
    <script type="application/javascript">
	    $(document).ready(function(e) { //alert('working');
            $(document).on('click', '.edit', function(e) {
				console.log('edit');

                var id = e.target.id;
                var edited = $('#edit-'+id).data('id');
                var req = $('#edit-'+id).data('req');
                var value = $('#edit-'+id).html();
                value = jQuery.trim(value);
                if(edited==1) {
                    $('#edit-'+id).html('<input type="text" value="'+value+'"  />');
                    $('#edit-'+id).data('id', 0);
                    $(this).html('Save');
                }
                if(edited==0) {
                    var edited_value = $('#edit-'+id+' input').val();
                    if(edited_value == '' && req == 1) {
                        $('#edit-'+id).prepend('<i class="red">Value Cannot be empty!</i>');
                    }else{
                        var title = $(this).data('title');
                        $(this).html('Edit');
                        var postFields = {title: title, value: edited_value, _token: CSRF_TOKEN};
                        var postUrl = "{{url('realtor/edit_profile')}}";
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
									$('#edit-'+id).html(edited_value);
									$('#edit-'+id).data('id', 1);
								}else{
									$('#edit-'+id).html(value);
									$('#edit-'+id).data('id', 1);
								}
							}
					    });
                    }
                }
            });
			$(document).on('click', '.editphone', function(e) { //alert('working');
				var id = e.target.id;
				var edited = $('#edit-'+id).data('id');
				var value = jQuery.trim($('#edit-'+id).html());
				if(edited==1) {
					$('#edit-'+id).html('<input type="text" value="'+value+'"  />');
					$('#edit-'+id).data('id', 0);
					$(this).html('Save');
				}
				if(edited==0) {
					var edited_value = $('#edit-'+id+' input').val();
					if(edited_value == '' || edited_value.length < 11) {
						$('#error-'+id).html('Enter a valid Phone Number');
					}else{
						var phone_id = $(this).data('title');
						$(this).html('Edit');
						$.ajax({
								url: '../processes/edit_realtor_phone.php',
								data: {phone_id: phone_id, value: edited_value},
								type: 'post',
								async: false,
								error: function(XMLHttpRequest, textStatus, errorThrown) {
								console.log(errorThrown);
								$('#edit-'+id).html(value);
								$('#edit-'+id).data('id', 1);
								},
								success: function(data){
									if(data==1) { 
										$('#edit-'+id).html(edited_value);
										$('#edit-'+id).data('id', 1);
									}else{
										$('#edit-'+id).html(value);
										$('#edit-'+id).data('id', 1);
									}
								}
						});
					}
					
				}
        	});
        });
    </script>

@endsection