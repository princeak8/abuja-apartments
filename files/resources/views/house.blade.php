@extends('layouts.public', ['page'=>'view house'])

@section('content') 

	@include('inc.public.frontpage.house_component.realtor_details')


	<!--  The body starts here  -->
	@include('inc.public.frontpage.house_component.house_details')

	@include('inc.public.frontpage.house_component.similar_house')

	<div class="disclaimer">
		<h4>Disclaimer</h4>
		<hr>
			<p>
			The information displayed about this property comprises a property advertisement. Abuja Apartments makes no warranty as to the accuracy or 
			completeness of the advertisement or any linked or associated information, and Abuja Apartments has no control over the content. 
			This property listing does not constitute property particulars.The information is provided and maintained 
			by <a href="www.zizix6.com">Zizix6</a>
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