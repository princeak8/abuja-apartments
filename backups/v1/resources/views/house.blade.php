@extends('layouts.public', ['page'=>'view house'])

@section('content') 

<div class="col-md-3 col-sm-3 left_details no-padding">
    <div class="panel panel-default">
        <div class="panel-heading">
    	   <h3 class="panel-title"><span class="fa fa-user"></span> Realtor Details <span class="fa fa-angle-down hi"></span>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#view_hs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
           </h3>
        </div>

        <div id="view_hs" class="panel-body collapse navbar-collapse">
           
            @foreach($house->realtors as $realtorHouse)

	           	<p class="det">
	                <p class="det_sub">
	            	<i class="fa fa-address-book"></i> : 
	            	@if($realtorHouse->realtor->type=='company') 
	            		{{$realtorHouse->realtor->biz_name}} 
	            	@else
	            		{{$realtorHouse->realtor->full_name}}
	            	@endif
	            	<br/>
	                
	                @if($realtorHouse->realtor->type=='company')
	                	<i class="fa fa-home"></i> : <span>Estate Management Firm</span> 
	                    @if($realtorHouse->realtor->verified==0) 
	                    	<span class="not_verify"> Not Yet Verified </span>
	                    @else
	                   	    <span class="verify">Verified</span>
	                    @endif
	                @else
	                	<i class="fa fa-user"></i> : <span>Agent</span>
	                    @if($realtorHouse->realtor->verified==0)
	                       <span class="not_verify"> Not Yet Verified </span>
	                    @else
	                        <span class="verify">Verified</span>
	                    @endif
	                @endif
	                <br/>

	                <i class="fa fa-envelope"></i> : {{$realtorHouse->realtor->email}}<br/>
	                <i class="fa fa-phone"></i> :
	                    <?php $i = 0; ?>
	            		@foreach($realtorHouse->realtor->phones as $phone)
	                        <?php $i++; ?>
	                        {{$phone->phone}}
	                        @if($i < $realtorHouse->realtor->phones->count())
	                        	,
	                        @endif
	                    @endforeach
	                <br/>
	                
	        		@if($realtorHouse->realtor->parent_id>0) 
	        			<b>Company: </b><span>{{App\Realtor::getRealtor($realtorHouse->realtor->parent_id)->biz_name}}</span><br/>
	        		@endif
	                </p>
	            </p>

	            <div class="mes_fol no-margin">
                <p class="no-margin">
                
                    @if(Auth::user() && Auth::user()->id != $realtorHouse->realtor->id)
                    	<div id="msg-sent-success" style="color: green; display: none;"><b>Message sent successfully</b></div>
	                    <a href="javascript:void(0)" onClick="messageClass.form({{$realtorHouse->realtor->id}}, {{Auth::user()->id}})" id="sender{{Auth::user()->id}}">
	                    	<span class="fa fa-envelope"></span> 
	                        Send Message to Realtor <span class="fa fa-caret-down"></span> 
	                    </a>
                    @endif
                    
                    <br/>
                  	<a href="{{url($realtorHouse->realtor->profile_name)}}" ><span class="fa fa-briefcase"></span> View Realtor House Portfolio <span class="fa fa-angle-double-right"></span> </a>
                    <div class="clear"></div>
                    
                    <div class="message_form" id="form{{$realtorHouse->realtor->id}}" style="display:none">
                    	<a href="javascript:void(0)" onClick="messageClass.hide()">Close Form</a>
                        <!--<input type="submit" class="form-control" value="SEND" onClick="messageClass.send()" />-->
                        <div class="form-content"></div>
                    </div>
                </p>   

                @if(Auth::user())
                    
                    @if(Auth::user()->type != 'company' && Auth::user()->id != $realtorHouse->realtor->id)  
                        @if(Auth::user() && !$realtorHouse->realtor->is_follower(Auth::user()->id)) 
                            {!! Form::open(['url' => 'follow', 'method'=>'post', 'style'=>'display:inline-block;']) !!}
                                <input type="hidden" name="followed" value="{{$realtorHouse->realtor->id}}" />
                                <input type="hidden" name="follower" value="{{Auth::user()->id}}" />
                                <button class="btn btn-info" type="submit" name="submit" value="Follow This Realtor" onclick="return confirm('Are you sure that you want to follow this realtor?')"><span class="fa fa-user-plus"></span> Follow This Realtor</button>
                                <!--<input type="submit" name="submit" value="Follow This Realtor" />-->
                            {!! Form::close() !!}
                        @endif 
                    	@if($realtorHouse->realtor->is_follower(Auth::user()->id))
	                    	<span class="ffg">You are following this realtor</span>
	                        {!! Form::open(['url' => 'unfollow', 'method'=>'post', 'name'=>'unfollow', 'style'=>'display:block;']) !!}
	                            <input type="hidden" name="follow_id" value="{{App\Follower::getFollow($realtorHouse->realtor->id, Auth::user()->id)->id}}" />
	                            <button class="btn btn-danger" id="unfollow" type="submit" name="submit" value="Unfollow" onclick="return confirm('Are you sure that you want to unfollow this realtor?')" ><span class="fa fa-user"></span><span class="fa fa-minus"></span> Unfollow</button>
	                            <!--<input class="btn-danger" id="unfollow" type="submit" name="submit" value="Unfollow" />-->
	                       	</form>
	                       	<div class="clear"></div>
                		@endif
                	@endif
                @endif
                <div class="clear"></div>
            </div>
            @endforeach

        </div><!-- End of the panel_body -->
        <div class="clear"></div>
    </div>
</div>


<!--  The body starts here  -->
<div class="col-md-6 col-sm-6 xs_nopad">

	<div class="col-sm-12 bg_white h_cont">
        <div class="col-sm-12 head_real">
	        @if($house->estate_id > 0) 
	            <h3>
	          		<a href="index.php?page=view estate&estate_id={{$house->estate->id}}">
	          			{{$house->estate->name}} 
	          		</a>
	            </h3>
	        @endif

	        <h4>House - {{$house->title}} </h4>

	        <div class="price1">
                <div class="col-sm-4 col-xs-6 locat_top">
                    <i class="fa fa-map-marker"></i> {{$house->location->name}}
                </div>
                <div class="col-sm-6 col-xs-6 price2" >
                    <span> 
                        ₦{{number_format($house->price)}}
						@if($house->status=='rent')
							(Per Annum)
						@endif
                    </span>
                </div>
                <div class="col-sm-2 col-xs-12 locat_top cap_1st">
                    <span>{{$house->status}}</span>
                </div>
            </div>
            <div class="clear"></div>

            <!--- Like Button for Registered Users  -->
            <div class="col-sm-12 no-padding lik_un">

            @if(Auth::user() && !$realtorHouse->realtor->is_follower(Auth::user()->id))  
                @if($house->liked(Auth::user()->id)) 
	                <form action="processes/unlike.php" name="unlike" method="post">
	                    <input type="hidden" name="like_id" value="{{App\House_like::getLike($house->id, Auth::user()->id)->id}}" />
	                    <button type="submit" name="submit" class="btn-danger" value="Unlike"><span class="fa fa-thumbs-down"></span> Unlike</button>
	                    <!--<input type="submit" name="submit" class="btn-danger" value="Unlike" /> -->
	                </form>
                @else
	                <form action="processes/like.php" method="post">
	                    <input type="hidden" name="realtor_id" value="{{Auth::user()->id}}" />
	                    <input type="hidden" name="type_id" value="{{$house->id}}" />
	                    <input type="hidden" name="type" value="house" />
	                    <button type="submit" name="submit"  class="btn-info" value="Like"><span class="fa fa-thumbs-up"></span> Like</button>
	                    <!--<input type="submit" name="submit" class="btn-success" value="Like" />-->
	                </form>
            	@endif 
            @endif
            @include('inc.public.share')
            <div class="clear"></div>
            
            </div>

        </div>

        <div class="col-sm-12 clear img_cont">
            <div id="full-images">
                @if($house->house_photos->count()==0) { ?>
                    <img src="images/no_image.png" />
                @else
                	@foreach($house->house_photos as $housePhoto) 
                		<img id="{{$housePhoto->id}}" class="house-img img-thumbnail" src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/{{$housePhoto->photo}}" @if($housePhoto->main == 1) style="z-index:1;" @endif /><br/>
                	@endforeach
       			@endif
            </div>
            
            <div class="col-sm-12 no-padding thumb_cont">
                <ul id="thumbnails" class="" data-id="{{$house->id}}">
                    @foreach($house->house_photos as $housePhoto)
	                    <li class="col-sm-4 col-md-3 col-xs-6 no-padding">
	                        <div class="thumb">
	                            <!--<a data-lightbox="example-1" data-lightbox="example-1" href="images/houses/<?php //echo $house->house_id.'/'.$photo; ?>" data-title="">-->
	                            <img class="house-timthumb img-thumbnail" data-id="{{$housePhoto->id}}" src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{$housePhoto->photo}}"  />
	                            <!--</a>-->
	                            <br/>
	                        </div>
	                    </li>
                    @endforeach
                    <script src="js/lightbox.js"></script>
                </ul> 
            </div>    
                <div class="clear"></div>
        </div>

        <div id="house-info" class="col-sm-12">

            <h4 class="h3"><span class="fa fa-edit"></span> House Information <i class="fa fa-caret-up"></i></h4>
            <div id="view_fold">
	            <div class="col-sm-12 no-margin view_locat">
	                <span class="fa fa-map-marker"></span> Location <i class="fa fa-angle-double-right"></i> {{$house->location->name}}
	                <span class="pull-right"> 
	                        ₦{{number_format($house->price)}} 
	                        @if($house->status=='rent')
	                            (Per Annum)
	                        @endif
	                    </span>
	            </div>
	            <div class="clear"></div>
	            <ul class="no-margin">
	                <div class="col-sm-12 col-xs-6 no-padding view_inf">
	                    <li class="col-sm-4 no-padding"><span class="fa fa-bed"></span> Bedrooms {{$house->bedrooms}}</li>
	                    <li class="col-sm-3 no-padding"><span class="fa fa-shower"></span> Bathrooms {{$house->bathrooms}}</li>
	                    <li class="col-sm-5 no-padding"><span class="fa fa-bank"></span> House Type <i class="fa fa-angle-double-right"></i> {{$house->house_type->type}}</li>
	                </div>

	                <div class="col-sm-12 col-xs-6 no-padding view_inf view_inf_xs">
	                    <li class="col-sm-4 no-padding"><span class="fa fa-list"></span> Total Rooms {{$house->rooms}}</li>
	                    <li class="col-sm-3 no-padding"><span class="fa fa-bath"></span> Toilets {{$house->toilets}}</li>
	                    <li class="col-sm-5 no-padding"><span class="fa fa-tint"></span> Water Source <i class="fa fa-angle-double-right"></i> {{$house->water_source}}</li> 
	                </div>
	                
	                <div class="col-sm-12 col-xs-12 no-padding">
	                    <div class="col-sm-12 view_des">Facilities <i class="fa fa-caret-down"></i> </div>
	                    <div class="col-sm-12 view_desful">{{$house->facilities}}</div>
	                </div>

	                <div class="col-sm-12 col-xs-12 no-padding">
	                    <div class="col-sm-12 view_des">Description <i class="fa fa-caret-down"></i> </div>
	                    <div class="col-sm-12 view_desful">{{$house->description}}</div>
	                </div>
	                
	                @if(!empty($house->sale_plan))
		                <div class="clear"></div>
		                <div class="col-sm-12 col-xs-12 no-padding">
		                    <div class="col-sm-12 view_des">Sale Plan <i class="fa fa-caret-down"></i> </div>
		                    <div class="col-sm-12 view_desful">{{$house->sale_plan}}</div>
		                </div>
	                @endif
	                
	                <div class="clear"></div>
	            </ul>
	            <div class="col-sm-12 no-padding no-margin fee">
	                <li class="col-sm-6 col-xs-6">Agent Fee : {{empty($house->agent_fee)? '₦ 0' : '₦ '.number_format($house->agent_fee)}}</li>
	                <li class="col-sm-6 col-xs-6">Service Charge : ₦{{number_format($house->service_charge)}}</li>
	                <div class="clear"></div>
	            </div>

	        </div>
	        <div class="clear"></div>
        </div>

        <div class="col-sm-12 comm">

        	@if(!Auth::user())
	            <h5>
	            	<a href="realtors/login.php"><span class="fa fa-sign-in"></span> Sign in</a> Or 
	                <a href="realtors/register.php"><span class="fa fa-edit"></span> Register</a> to comment on this house
	            </h5>
            @endif

            <section class="sect">
				<h3 id="comment-count"><span class="fa fa-comments"></span> Comments {{$house->house_comments->count()}}</h3>
                <div id="comments">
					@foreach($house->house_comments as $comment) { 
                        <div class="comment col-sm-12 col-md-12">
                            <i class="pull-right">{{date('jS M Y', $comment->created_at)}}</i>
                            <h4><span class="fa fa-user"></span> {{$comment->realtor->fullname}} </h4>
                            <p>
                                {{$comment->comment}}
                            </p>
                            <hr/>
                            @if(Auth::user()) 
								@if((Auth::user()->id==$house->id) || (Auth::user()->id==$comment->realtor_id)) 
                                    <a class="btn-danger" href="{{url('delete_comment/'.$comment->id)}}" 
                                     onClick=" return confirm('Are You Sure You Want to delete this comment?')"><span class="fa fa-trash"></span> Delete
                                     </a>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <div class="clear"></div>                
			</section>

			<div class="clear"></div>
                @if((Auth::user()) && (Auth::user()->type!='company') && (Auth::user()->id != $house->realtor_id) && (Auth::user()->connected_house($house->id)))
            		<section class="sect1">
							<h3>LEAVE A COMMENT</h3>
	                    
	                    <p id="comment-msg"></p>
	                    
	                    <div class="form-group">
	                		<textarea class="form-control" name="comment" rows="8"> </textarea>
	                    </div>
	                    <div class="form-group">
	                    <img id="imgcaptcha" src="processes/captchaimg.php" /><br/>
	                    Enter the Value of the captcha image above<br/>
	                    <input class="form-control" type="text" name="captcha" required  />
	                    </div>
	                    
	                    <input type="hidden" class="form-control" id="captcha_check" />
	                    <input type="hidden" name="count" value="{{$house->house_comments->count()}}" />
	                    <input type="hidden" name="house_id" value="{{$house->id}}" />
	                    <input type="hidden" name="realtor_id" value="{{Auth::user()->id}}" />
	                    <input type="hidden" name="realtor_name" value="{{Auth::user()->fullname}}" />
	                    <div class="form-group">
	                    <input type="submit" class="form-control btn-info" name="submit-comment" value="Comment" />
	                    </div> 
                 	</section>
            	@endif

        </div>


    </div>
</div>

<div class="col-md-3 col-sm-3 no-padding similar">
    <div class="panel panel-default">
        <div class="panel-heading">
    	   <h3 class="panel-title">Similar Houses</h3>
        </div>
        <div class="panel-body">
	        @if($similar_houses->count()==0) {
	    		echo "No similar available house";
	    	@else
	    	  	@foreach($similar_houses as $house) 
		        	<div id="similar-house" class="col-md-12 col-sm-12 no-padding">
		                <div class="similar_xs">
		            	<a href="{{url('house/'.$house->id)}}">
		                    <div class="sim_img pull-left">
			                    @if(App\House_photo::GetMainPhoto($house->id)->count())
		                            <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetMainPhoto($house->id)->first()->photo}}" />
		                        @elseif(App\House_photo::GetHousePhotos($house->id)->count())
		                            <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetHousePhotos($house->id)->first()->photo}}" />
		                        @else
		                            <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
		                        @endif
		                    </div>
		                </a>
		                
		                <ul>
		                	<li><span class="fa fa-caret-right"></span> {{$house->title}}
		                    </li>
		                    <li><span class="fa fa-caret-right"></span> {{$house->house_type->type}}
		                    </li>
		                    <li><span class="fa fa-caret-right"></span> {{$house->location->name}}
		                    </li>
		                    <li><span class="fa fa-caret-right"></span> ₦{{number_format($house->price)}}
		                        @if($house->status=='rent')
		                            (Per Annum)
		                        @else
		                             (For Sale)
		                        @endif
		                    </li>
		                    
		                </ul>
		                </div>
		            </div>
	        	@endforeach
	        @endif
        </div>
    </div>    
</div>

<div class="clear"></div>
<div class="col-sm-12 disclaimer">
        <h4>Disclaimer</h4>
        <p>
The information displayed about this property comprises a property advertisement. Abuja Apartments makes no warranty as to the accuracy or completeness of the advertisement or any linked or associated information, and Abuja Apartments has no control over the content. This property listing does not constitute property particulars.The information is provided and maintained by <a href="www.zerothweb.com.ng">Zeroth Web</a>
    </p>

</div>

<script type="application/javascript">

$(document).ready(function(e) {
    //alert('working');
    CSRF_TOKEN = $('input[name=_token]').val();
    $('.house-timthumb').click(function(e) {
        var photo_id = $(this).data('id');
    
        $('.house-img').filter(function() {
        return $(this).css('z-index') == 1;
        }).each(function() {
            $(this).css('z-index', 0);   
        });
        $('#'+photo_id).css('z-index', 1);
    });
})

function Message() {
	
	this.form = function(receiver_id, sender_id) { //alert('show');
		var form = '';
		$('#form-msg'+this.receiver_id).html('');
		
		if(typeof(sender_id)==='undefined') {
			form += '<input class="form-control" type="text" name="name" placeholder="Full Name" required /><br/>';
			form += '<input class="form-control" type="text" name="phone" placeholder="Phone Number" required /><br/>';
			form += '<input class="form-control" type="text" name="email" placeholder="Email" required /><br/>';
		}else{
			this.sender_id = sender_id;
		}
		
		if(typeof(this.receiver_id)!='undefined') { // If there is an open form, hide it
			$('#form'+this.receiver_id).css('display', 'none');
			$('#sender'+this.receiver_id).css('display', 'block');
		}
		
		this.receiver_id = receiver_id;
		//alert(this.receiver_id);
		
		form += '<textarea class="form-control" name="message" rows="8"></textarea><br/>';
		form += '<input class="form-control btn btn-info orator" type="submit" name="submit" value="Send Message" onClick="messageClass.send()" />';
		
		$('#form'+receiver_id+' .form-content').html(''); // Clear form-content div
		$('#form'+receiver_id+' .form-content').append(form); // Add new dynamic form fields to the form-content div
		$('#form'+receiver_id).css('display', 'block'); // Display the form
		$('#sender'+receiver_id).css('display', 'none'); // Hide the 'send msg to realtor' link
	}
	
	this.send = function() {
		//alert(this.receiver_id);
		var related = 'house';
		var related_id = '{{$house->id}}';
		var error = '';
		var message = $('#form'+this.receiver_id+' .form-content textarea[name=message]').val();
		var receiver_id = this.receiver_id;
		if(typeof(this.sender_id)==='undefined') {
			var name = $('#form'+this.receiver_id+' .form-content input[name=name]').val();
			var phone = $('#form'+this.receiver_id+' .form-content input[name=phone]').val();
			var email = $('#form'+this.receiver_id+' .form-content input[name=email]').val();
			var postFields = {name: name, phone: phone, email: email, message: message, receiver_id: receiver_id, related: related, related_id: related_id, _token: CSRF_TOKEN};
			if(phone == '' && email==''){
				var error = '<p id="form-error" style="color:red; font-size:11px;"><b>Enter your phone number or email or both</b></p>';
			}
		}else{
			var sender_id = this.sender_id;
			var postFields = {message: message, receiver_id: receiver_id, sender_id: sender_id, related: related, related_id: related_id, _token: CSRF_TOKEN};
		}
		
		if(message=='') {
			var error = '<p id="form-error" style="color:red; font-size:11px;"><b>Message Field cannot be empty</b></p>';
		}
		if(error != '') {
			$('#form'+receiver_id+' .form-content #form-error').hide();
			$('#form'+receiver_id+' .form-content').prepend(error);
		}else{
			$.ajax({
				url:"{{url('send_message')}}", 
				data:postFields, 
				type: "post", 
				async: false, 
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(errorThrown);
				   $('#sender'+receiver_id).html('<p style="color:red; font-size:11px;"><b>Problem occured while attempting to send message</b></p>');
				}, 
				success: function(data) { 
					//alert('success');
					//alert(data);
					$('#msg-sent-success').css('display', 'block');
					$('#sender'+receiver_id).before(data);
				}
			}) 
			this.hide();
		}
	}
	
	this.hide = function() {
		$('#sender'+this.receiver_id).css('display', 'block');
		$('#form'+this.receiver_id).css('display', 'none');
	}
}

messageClass = new Message();

		$(document).ready(function(e) {
            $('form[name=unlike]').submit(function(e) {
				if(confirm("Are You Sure You want to Unlike this House?")) {
					return true;
				}else{
                	return false;
				}
            });
        });

</script>
<script type="application/javascript">
$(document).ready(function(e) {
    //alert('working');
    $('#house-info h4').click(function(){
        $('#view_fold').slideToggle(function(){
                if($(this).is(":hidden")){
                    $('#house-info h4 i').removeClass('fa fa-caret-up').addClass('fa fa-caret-down');
                }else{
                    $('#house-info h4 i').removeClass('fa fa-caret-down').addClass('fa fa-caret-up');
                }
            });

    });

	
	$.ajax({
		url: 'processes/captchacheck.php',
		type: 'post',
		async: false,
		success: function(data){
			//alert(data);
			$('#captcha_check').val(data);
			}
	});
	$('input[name=submit-comment]').click(function(e) {
		var comment = $('textarea[name=comment]').val();
		var realtor_id = $('input[name=realtor_id]').val();
		var realtor_name = $('input[name=realtor_name]').val();
		var house_id = $('input[name=house_id]').val();
		var count = $('input[name=count]').val();
		var captcha = $('input[name=captcha]').val();
		var captcha_check = $('#captcha_check').val();
		var new_count = parseInt(count) + 1;
		var error = '';
		
		if(captcha != captcha_check) {
			error = 'Wrong Captcha Value Entered';
		}
		if(captcha == '') {
			error = 'Captcha Field Empty!!';
		}
		if(!$.trim(comment)) {
			error = 'Comment Field Empty!! Please Enter your Comment';
		}
		
		if(error != '') {
			$('#comment-msg').addClass('red');
			$('#comment-msg').html(error);
       		return false; 
		}else{
			//alert(comment);
			$.ajax({
				url: 'processes/comment.php',
				data: {house_id: house_id, comment: comment, realtor_id: realtor_id, captcha: captcha},
				type: 'post',
				async: false,
				success: function(data){
					if(data.success == 0) {
						$('#comment-msg').addClass('red');
						$('#comment-msg').html(data.msg);
						$('html, body').animate({
							scrollTop: $('#comment-msg').offset().top
						}, 'slow');
					}else{
						//alert(data.date);
						var content = '';
						content += '<div class="comment col-sm-12 col-md-12 shadow1">';
						content += '<i class="pull-right">'+data.date+'</i>';
						content += '<h4><span class="fa fa-user"></span> '+realtor_name+'</h4>';
						//content += '<br/>';
						content += '<p>';
						content += comment;
						content += '</p>';
						content += '<hr/>';
						//content += '<button class="btn-danger"> ';                    
             			content += '<a class="btn-danger" href="processes/delete_comment?comment_id='+data.comment_id+'" onClick="confirm(\'Are You Sure You Want to delete this comment?\')">';
             			content += '<span class="fa fa-trash"></span> delete';
             			content += '</a>';
           				//content += '</button>';
						content += '</div>';
						$('#comments').prepend(content);
						
						$('html, body').animate({
							scrollTop: $('#comments').offset().top
						}, 'slow');
						
						$('textarea[name=comment]').val('');
						$('input[name=captcha]').val('');
						$('input[name=name]').val('');
						$('#comment-count').html('Comments('+new_count+')');
					}
				}
			});
		}
    });
	
});
</script>

@endsection