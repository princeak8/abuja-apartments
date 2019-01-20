<script type="application/javascript">
		$(document).ready(function(e) {
			var init_status = $('input[name=status]:checked').val();
			if(init_status == 'sale') {
				$('#s-plan').css('display', 'inline-block');
		    	$('#per-anum').css('display', 'none');
			}
			
			var init_purpose = $('input[name=purpose]:checked').val();
			if(init_purpose == 'commercial') {
				$('#bedrooms input').removeAttr('required'); $('#bedrooms').css('display', 'none'); 
			}

			$(document).on('click','input[name=status]',function(e) {
				var status = $(this).val();
			   //alert(status);
			   if(status=='sale') {
				   	$('#s-plan').css('display', 'block');
				   	$('#units').css('display', 'block');
		       		$('#per-anum').css('display', 'none');
			   }else{
				   	$('#s-plan').css('display', 'none');
		       		$('#per-anum').css('display', 'inline-block');
		       		$('#units').css('display', 'none');
			   }
			})
			
			$(document).on('click','input[name=purpose]',function(e) {
				var purpose = $(this).val();
			   
			   if(purpose=='commercial') {
				   $('#bedrooms input').removeAttr('required');  $('#bedrooms').css('display', 'none');  
			   }else{
				  $('#bedrooms input').prop('required',true);  $('#bedrooms').css('display', 'block');
			   }
			})
		  
			$('#add-house-form').submit(function(e) {
				/*var description = $('#description').val();
				if(empty(description)) {
					$('#description').css('border', '#FF0000 thin solid');
					$('#description').attr('autofocus');
		        	return false;
					alert('working');
				}else{
					alert('not empty');
				}
				alert(description);
				return false;*/
		    });
		});
	</script>