// JavaScript Document
function showFiltering() {
	$('#filtering').css('display', 'block');
}
function hideFiltering() {
	$('#filtering').css('display', 'none');
}
function get_title_heading(filter) {
	var titleHeading = "";
	switch(filter) {
		case 	'house_type_id' : 
				titleHeading = 'House Type'; 
				break;
		case    'location_id' : 
				titleHeading = 'Location'; 
				break;
		case    'price_range_id' : 
				titleHeading = 'Price Range'; 
				break;
		// Unset the filter and title so to disable multiple filtering for the status
		case    'status' : 
				titleHeading = 'Status';
				break;
		case    'bedrooms' : 
				titleHeading = 'Bedrooms'; 
				break;
		default : 
				titleHeading = 'Uknown';
	}
	return titleHeading;
}
$(document).ready(function(e) { 
	var filters = {}; 
	var values = [];
	var titleValues = [];
	var titles = {};
	var realtorId = $('#realtor-id').val();
	filters['realtor_id'] = realtorId;
	
        $('#left-side input').change(function(e) {
			showFiltering();
            var value = $(this).val();
			var filter = $(this).attr('name');
			var title = $(this).data('id');

			var titleHeading = get_title_heading(filter);
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
				if(filter == 'status' || value == 'all') {
					filters[filter] = value;
					delete titles[titleHeading];
				}else{
					if(filter in filters && filters[filter] != 'all') {
						values = filters[filter];
						values.push(value);
						filters[filter] = values;
					}else{
						if(filters[filter] == 'all') {
							delete filters[filter];
						}
						values = [];
						values.push(value);
						filters[filter] = values;
					}
				}
	
				if(titleHeading in titles && filters[filter] != 'all') {
					titleValues = titles[titleHeading];
					titleValues.push(title);
					titles[titleHeading] = titleValues;
				}else{
					if(filters[filter] == 'all') {
						delete titles[titleHeading];
					} else {
						titleValues = [];
						titleValues.push(title);
						titles[titleHeading] = titleValues;
					}
				}
			}else{
				var checked = 0;
				var index = filters[filter].indexOf(value);
				if (index !== -1) {
					filters[filter].splice(index, 1);
					if(filters[filter].length==0) {
						delete filters[filter];
					}
				}
	
				var index = titles[titleHeading].indexOf(title);
				if (index !== -1) {
					titles[titleHeading].splice(index, 1);
					if(titles[titleHeading].length==0) {
						delete titles[titleHeading];
					}
				}
			}
			console.log(filters);
			console.log(titles);

			var postUrl = APP_URL+"api/v1/filter_houses";
			var postFields = {filters: filters};
			$.ajax({
				url:postUrl, 
				data:postFields, 
				type: "post", 
				async: false, 
				error: function(XMLHttpRequest, textStatus, errorThrown) {
				  console.log(errorThrown);
				},
				success: function(data) { 
					var output = '';
					if(titles != '') {
						output += '<div class="col-md-12">';
						// output += '<h4 class="h5">FILTERS ON ';
							output += `<div style="display:flex; flex-direction:row; flex-wrap: wrap">`
								$.each(titles, function(key, title) { 
									
									output += `<div class="filterTags">`
										output += `<p class="title">${key} </p>`;
										$.each(title, function(key, tit) { 
											
											output += `<div>${tit} </div>`;
											
										});
									output += `</div>`;
									
								});
							output += `</div>`;
						output += '</div>';
						// output += '</h4>'
					}
					console.log(data.house);
					if(data.house == '') {
						output += '<h4><b class="h4 h4-xs">No Results for the Selected Filter</b></h4>';
					}else{
						$.each(data.house, function(key, val) {
							output += '<div class="col-xs-6 col-md-4 col-sm-6 cont_xs2">';
								output += '<div class="house_cont cont_xs1">';

									//Location On Top of the pictures
									output += '<div class="locat">';
										output += '<span class="fa fa-map-marker"></span> '+val.location;
										if(val.estate != '') { 
											output += ' <span>('+val.estate+' Estate</span>)';
										} 
									output += '</div>';
									//The image div
									output += '<div class="col-md-12 col-xs-12 no-padding">';
										output += '<a href="house/'+val.house_id+'">';
											output += '<div class="img">';
												output += '<img src="'+val.photo+'" />';
											output += '</div>';
										output += '</a>';
									output += '</div>';

									//The Price Tag
									output += '<div class="price">';
										output += 'N '+val.price;
									output += '</div>';

									// The div below the Pictures
									output += '<div class="no-padding bath bath_re">';
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
												output += '<li><span class="fa fa-caret-right"></span> '+val.location;
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
					$('#displayed-houses').val(data.displayed_houses);
					$('#db-content').html(output);
					hideFiltering();
				}
			});
        });
    });