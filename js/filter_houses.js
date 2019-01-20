// JavaScript Document
function showFiltering() {
	$('#filtering').css('display', 'block');
}
function hideFiltering() {
	$('#filtering').css('display', 'none');
}
$(document).ready(function(e) { 
	APP_URL = $('input[name=APP_URL]').val();
	APP_STORAGE = $('input[name=APP_STORAGE]').val();
    $('#left-side input').change(function(e) {
		showFiltering();
	    var value = $(this).val();
		var filter = $(this).attr('name');
		var title = $(this).data('id');
		//alert(filter);
		if($(this).is(":checked")) {
			var checked = 1;
			var name = $(this).prop('name');
			if(name != 'status') { 
				if(value != 'all') {
					$('input[type=radio][name='+name+']').prop('checked', false);
				}else{ 
					$('input[type=checkbox][name='+name+']').prop('checked', false);
				}	
			}
		}else{
			var checked = 0;
		}

		CSRF_TOKEN = $('input[name=_token]').val();
		var postUrl = APP_URL+"api/filter_houses";
		var postFields = {filter: filter, value: value, title: title, checked: checked};
		
		$.ajax({
			url:postUrl, 
			data:postFields, 
			type: "post", 
			//async: false, 
			error: function(xhr, textStatus, errorThrown) {
	            console.log(xhr.responseText);
	            //alert(xhr.responseText);
	        },
			success: function(data) { 
				console.log(data);
				//data = JSON.parse(data); 
				/*try {
					data = JSON.parse(data); 
				}catch(e){
					console.log(e);
				}*/
				var output = '';
				if(data.title != '') {
					output += '<div class="col-md-12 sub no-padding">';
					output += '<h4 class="h5">FILTERS ON <i class="fa fa-angle-right"></i> ';
					$.each(data.title, function(key, title) { 
						output += '<b>'+key+':</b> ';
						$.each(title, function(key, title) {
							output += '<span>'+title+'</span>, ';
						});
						output += ' | ';
					});
					output += '</h4>';
					output += '</div>';

				}
				if(data.house == '') {
					output += '<h4><b class="h4 h4-xs">No Results for the Selected Filter</b></h4>';
				}else{
					$.each(data.house, function(key, val) {
						output += '<div class="col-xs-6 col-md-3 col-sm-4 cont_xs2">';
						output += '<div class="house_cont cont_xs1">';
						//Location On Top of the pictures
						output += '<div class="locat">';
						output += '<span class="fa fa-map-marker"></span> '+val.location;
						if(val.estate != '') { 
							output += ' <span>('+val.estate+' Estate</span>)';
						} 
						output += '</div>';
						//The image div
						output += '<div class="col-sm-12 col-xs-12 no-padding">';
						output += '<a href="index.php?page=view house&house_id='+val.house_id+'">';
						output += '<div class="img">';
						output += '<img src="'+APP_STORAGE+'images/houses/'+val.house_id+'/thumbnails/'+val.photo+'" />';
						output += '</div>';
						output += '</a>';
						output += '</div>';

						//The Price Tag
						output += '<div class="price">';
						output += 'N '+val.price;
						output += '</div>';

						// The div below the Pictures
						output += '<div class="no-padding bath">';
						output += '<ul class="no-margin no-padding">';
						output += '<li><span class="fa fa-bed"></span> ';
						output += val.bedrooms;
						if(val.bedrooms <= 1){
							output += ' bedroom';
						}else{
							output += ' bedrooms';
						}
						output += '</li>';
						output += '<li><span class="fa fa-shower"></span> '+val.bathrooms;
						if(val.bathrooms <= 1){
							output += ' bathroom';
						}else{
							output += ' bathrooms';
						}
						output += '</li>';
						output += '<li><span class="fa fa-shower"></span> '+val.toilets;
						if(val.toilets <= 1){
							output += ' toilet';
						}else{
							output += ' toilets';
						}
						output += '</li>';
						output += '<div class="clear"></div>';
						output += '</ul>';
						output += '</div>';

						//Description of the house starts here 
						output += '<div class="col-md-12 col-xs-12 cont_descript">';
						output += '<div class="descript">';
						output += '<ul class="no-padding">';
						output += '<li><span class="fa fa-tag"></span> '+val.title+'</li>';
						output += '<li><span class="fa fa-clone"></span> '+val.house_type+'</li>';
						if(val.estate != '') { 
							output += '<li><span class="fa fa-list-ul"></span> '+val.estate+' Estate';
							output += '<span>('+val.units+' Units)</span>';
							output += '</li>';
						} 
						output += '</ul>';
						output += '<a href="index.php?page=view house&house_id='+val.house_id+'"><span class="fa fa-external-link"></span> View details <span class="fa fa-angle-double-right"></span> </a>';
						output += '</div>';

						//Cont_lik starts
						output += '<div class="cont_lik col-sm-12 col-xs-12">';
						output += '<hr/>';
						output += '<p class="pull-left">';	
						output += 'For '+val.status;
						output += '</p>';
						output += '<div class="pull-right">';
			            output += '<i><span class="fa fa-thumbs-up"></span> Likes['+val.house_likes+']</i> ';
						output += '<i><span class="fa fa-comments"></span> Comments['+val.comments+']</i>';
			            output += '</div>';
						output += '</div>';//end of cont_lik
						output += '</div>';//end of col-md-12 cont_descript
						output += '<div class="clear"></div>';
						
						output += '</div>';//End of house_cont

					  	output += '</div>';	//End of cont_xs2
					})

				}
						
				$('#total-houses').val(data.total_houses);
				alert(data.total_houses);
				$('#displayed-houses').val(data.displayed_houses);
				$('#db-content').html(output);
				hideFiltering();
			}
		});
	});
});