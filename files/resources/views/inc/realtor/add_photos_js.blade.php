<script type="application/javascript">

		function error_exists(submitError)
		{
			var sum = 0;
			for(var error in submitError) {
				sum = sum + submitError[error];
			}
			return sum;
		}
		var submitError = {};
	  	
	  	//alert(errorExists);

	  $(document).ready(function(e) {
	  	
	    var i = 1;
	        $(document).on('click', '#add-more button', function() {  
	      i++;
	      var input = '';

	      input += '<div class="" style="margin-bottom:5px;" id="photo-'+i+'">'

	        //input += '<div class="col-md-11" style="margin:0px; padding:0px;" id="photo-'+i+'">'; 
	        input += '<div class="col-lg-8 col-12">';
						input += '<div class="row">';
							input += '<img id="data'+i+'" class="col-lg-3 col-5" />';
							input += '<span id="info'+i+'" class="col-lg-7 col-6"></span>';
						input += '</div>';
	          
	        input += '</div>'; 

	        input += '<div class="form-group row">'; 
	          input += '<div class="col-11 pr-0">';
							input += '<div class="form-group">';
								input += '<input class="form-control photo form-control-sm" type="file" id="photo_'+i+'" data-id="data'+i+'" name="photo[]" />';
							input += '</div>';
							input += '<div class="form-group">';	
								input += '<input class="form-control form-control-sm" type="text" name="photo_title[]" size="50" placeholder="Photo Name/Title" />';
							input += '</div>';

	          input += '</div>';
	          input += '<div class="col-1 pl-0">';
	            input += '<button type="button" class="btn btn-danger btn-sm col-12" data-id="photo-'+i+'">X</button>';
	          input += '</div>'; 

	        input += '</div>';//End of form-group
	        input += '<div class="clear"></div>';
	      input += '</div>';  //End of id="photo-id" 

	      $('#photo-inputs').append(input);
	      if(i >= 5) {
	          $('#add-more').css('display', 'none');
	        }
	      //alert('i: '+i);  
	      })
	    
	    $(document).on('click', '#photo-inputs button', function(e) { 
	      var id = $(this).data('id');
	      
	      $('#'+id).remove();
	      $(this).remove();
	      i--;
	      //alert('i: '+i);
	      if(i <= 5){
	        $('#add-more').css('display', 'block');
	      }
	    });

	  });//close tag for the document.ready() function

	$(document).on('change', '.photo', function(e) {
		var id = $(this).data('id');
	    var fileId = $(this).attr('id');
		var reader = new FileReader();

	    reader.onload = function (e) {
	        // get loaded data and render thumbnail.
	    $('#'+id).css('margin-top', '5'+'px');    
			$('#'+id).attr('width', '50');
			$('#'+id).attr('height', '60');
			$('#'+id).attr('src', e.target.result); 
	    };

	    // read the image file as a data URL.
	    reader.readAsDataURL(this.files[0]);

	    GetFileInfo (fileId);
	});
		  
		  
	        function GetFileInfo (id) { 
	            var fileInput = document.getElementById (id);
	            
	            var message = "";
	            if ('files' in fileInput) {
	                if (fileInput.files.length == 0) {
	                    message = "Please browse for one or more files.";
	                } else {
	                    for (var i = 0; i < fileInput.files.length; i++) {
	                       // message += "<br /><b>" + (i+1) + ". file</b><br />";
	                        var file = fileInput.files[i];
	                        if ('name' in file) {
	                            message += "<p><b class='burgundy'> Name: </b>"+ file.name +"</p>";
	                        }
	                        else {
	                            message += "<p><b class='burgundy'> Name: </b>"+ file.fileName +"</p>";
	                        }
	                        if ('size' in file) {
	                            message += "<p><b class='burgundy'> Size: </b>" + file.size/1000 +" Kb </p>";
	                        }
	                        else {
	                            message += "<p><b class='burgundy'> Size: </b>"+ file.fileSize/1000 +" Kb </p>";
	                        }
	                        if ('mediaType' in file) {
	                            message += "<p><b class='burgundy'> Type: </b>"+ file.mediaType +"</p>";
	                        }
	                    }
	                }
	            } 
	            else {
	                if (fileInput.value == "") {
	                    message += "Please browse for one or more files.";
	                    message += "<br />Use the Control or Shift key for multiple selection.";
	                }
	                else {
	                    message += "Your browser doesn't support the files property!";
	                    message += "<br />The path of the selected file: " + fileInput.value;
	                }
	            }

	            var str = id.split("_");
	            //alert(str[1]);
	            var info = document.getElementById ("info"+str[1]);
	            
	            if(file.size > 10048576) {
	                info.innerHTML = message+'<i style="color:pink">Allowed Max size for upload exceeded</i><br/>';
	                $("input[name=submit]").prop('disabled', true);
	                submitError[id] = 1;
	            }else{
	                info.innerHTML = message;
	                submitError[id] = 0;
	            }

	            errorNo = error_exists(submitError);
		 		if(errorNo <= 0) {
		 			$("input[name=submit]").prop('disabled', false);
	        	}

	 }
	</script>