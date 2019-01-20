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
		var postUrl = APP_URL+"filter_houses2";
		var postFields = {filter: filter, value: value, title: title, checked: checked, _token: CSRF_TOKEN};
		
		$.ajax({
			url:postUrl, 
			data:postFields, 
			type: "post", 
			dataType: "xml",
			//async: false, 
			error: function(xhr, textStatus, errorThrown) {
	            console.log(xhr.responseText);
	            //alert(xhr.responseText);
	        },
			success: function(data) {  
				var filters = $(data).find("filters");
				var output = '';
				if(filters.length > 0) {
					output += '<div class="col-md-12 sub no-padding">';
					output += '<h4 class="h5">FILTERS ON <i class="fa fa-angle-right"></i> ';
					$(data).find('filters').each(function(){
						var group = $(this).attr("group");
						output += '<b>'+group+':</b> ';
						//console.log(group);
						$(filters).find('filter').each(function(){
							var filter = $(this).text();
							//console.log(filter);
							output += '<span>'+filter+'</span>, ';
							output += ' | ';
					
						});
					});
					output += '</h4>';
					output += '</div>';
					
				}
				var houses = $(data).find("house");
				var displayed_houses = $(data).find("displayed_houses").text();
				var total_houses = $(data).find("total_houses").text();
				if(houses.length == 0) {
					output += '<h4><b class="h4 h4-xs">No Results for the Selected Filter</b></h4>';
				}else{
					$(data).find('house').each(function(){
						var house_id = $(this).find('house_id').text();
						var location = $(this).find('location').text();
						var location_id = $(this).find('location_id').text();
						var house_type = $(this).find('house_type').text();
						var bedrooms = $(this).find('bedrooms').text();
						var bathrooms = $(this).find('bathrooms').text();
						var toilets = $(this).find('toilets').text();
						var estate = $(this).find('estate').text();
						var units = $(this).find('units').text();
						var title = $(this).find('title').text();
						var status = $(this).find('status').text();
						var price = $(this).find('price').text();
						var range_id = $(this).find('range_id').text();
						var house_likes = $(this).find('house_likes').text();
						var comments = $(this).find('comments').text();
						var photo = $(this).find('photo').text();
						//console.log(house_type);

						output += '<div class="col-xs-6 col-md-3 col-sm-4 cont_xs2">';
						output += '<div class="house_cont cont_xs1">';
						//Location On Top of the pictures
						output += '<div class="locat">';
						output += '<span class="fa fa-map-marker"></span> '+location;
						if(estate != '') { 
							output += ' <span>('+estate+' Estate</span>)';
						} 
						output += '</div>';
						//The image div
						output += '<div class="col-sm-12 col-xs-12 no-padding">';
						output += '<a href="index.php?page=view house&house_id='+house_id+'">';
						output += '<div class="img">';
						output += '<img src="'+APP_STORAGE+'images/houses/'+house_id+'/thumbnails/'+photo+'" />';
						output += '</div>';
						output += '</a>';
						output += '</div>';

						//The Price Tag
						output += '<div class="price">';
						output += 'N '+price;
						output += '</div>';

						// The div below the Pictures
						output += '<div class="no-padding bath">';
						output += '<ul class="no-margin no-padding">';
						output += '<li><span class="fa fa-bed"></span> ';
						output += bedrooms;
						if(bedrooms <= 1){
							output += ' bedroom';
						}else{
							output += ' bedrooms';
						}
						output += '</li>';
						output += '<li><span class="fa fa-shower"></span> '+bathrooms;
						if(bathrooms <= 1){
							output += ' bathroom';
						}else{
							output += ' bathrooms';
						}
						output += '</li>';
						output += '<li><span class="fa fa-shower"></span> '+toilets;
						if(toilets <= 1){
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
						output += '<li><span class="fa fa-tag"></span> '+title+'</li>';
						output += '<li><span class="fa fa-clone"></span> '+house_type+'</li>';
						if(estate != '') { 
							output += '<li><span class="fa fa-list-ul"></span> '+estate+' Estate';
							output += '<span>('+units+' Units)</span>';
							output += '</li>';
						} 
						output += '</ul>';
						output += '<a href="index.php?page=view house&house_id='+house_id+'"><span class="fa fa-external-link"></span> View details <span class="fa fa-angle-double-right"></span> </a>';
						output += '</div>';

						//Cont_lik starts
						output += '<div class="cont_lik col-sm-12 col-xs-12">';
						output += '<hr/>';
						output += '<p class="pull-left">';	
						output += 'For '+status;
						output += '</p>';
						output += '<div class="pull-right">';
			            output += '<i><span class="fa fa-thumbs-up"></span> Likes['+house_likes+']</i> ';
						output += '<i><span class="fa fa-comments"></span> Comments['+comments+']</i>';
			            output += '</div>';
						output += '</div>';//end of cont_lik
						output += '</div>';//end of col-md-12 cont_descript
						output += '<div class="clear"></div>';
						
						output += '</div>';//End of house_cont

					  	output += '</div>';	//End of cont_xs2
					})

				}
						
				$('#total-houses').val(total_houses);
				$('#displayed-houses').val(displayed_houses);
				$('#db-content').html(output);
				hideFiltering();
			}
		});
	});
});