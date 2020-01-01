// JavaScript Document
function showFiltering() {
	$('#filtering').css('display', 'flex');
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
		console.log(titles);
		//console.log("Filter:"+filter+" Value:"+value+" Checked:"+checked);

		var postUrl = APP_URL+"api/v1/filter_houses";
		var postFields = {filters: filters};
		
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
				console.log(data.title);
				//data = JSON.parse(data); 
				/*try {
					data = JSON.parse(data); 
				}catch(e){
					console.log(e);
				}*/
				var output = '';
				if(data.title != '') {
					output += '<div class="col-md-12">';
					output += '<h4 class="h5">FILTERS ON ';
					
					$.each(titles, function(key, title) { 
						output += `<b>${key} :</b>`;
						
						$.each(title, function(key, title) {
							output += `<span>${title}</span>, `;
						});
						
						output += ' | ';
					});
					output += '</h4>';
					output += '</div>';

				}
				if(data.house == '') {
					output += '<h4><b class="h4">No Results for the Selected Filter</b></h4>';
				}else{
					$.each(data.house, function(key, val) {
						output +=  `<div class="col-lg-3 col-sm-6 px-3">
								   		<div class="house mouseoverHouse">  
											<div class="cover"></div>
											<div class="house__upper"> 
												<div class="house__upper__location">
													<span class="fa fa-map-marker-alt"></span>${val.location}
													${val.estate_id > 0 ? '(<span>'+ val.estate+ '</span>)' : ''}
												</div>
												<div class="house__upper__img_price">
													<a href="house/${val.house_id}">
														<div class="house__upper__img_price__img ">
															<img src="${val.photo}" />
														</div>
													</a>
	
													<div class="house__upper__img_price__price">
														₦${val.price} 
													</div>
												</div>
												<div class="house__upper__bath">
													<ul>
														<li><span class="fa fa-bed"></span> ${val.bedrooms} 
															${val.bedrooms <= 1 ? 'bedroom' : 'bedrooms'}
														</li>
														<li><span class="fa fa-shower"></span> ${val.bathrooms} 
															${val.bathrooms <= 1 ? 'bathroom' : 'bathrooms'}
														</li>
														<li><span class="fa fa-bath"></span> ${val.toilets} 
															${val.toilets <= 1 ? 'toilet' : 'toilets'}
														</li>
													</ul>
												</div>
											</div>
							
											<div class="house__details mouseoverDetails">
												<a href="house/${val.house_id}">
													<div class="house__details__upper">
														<ul>
															<li><i class="fa fa-tag"></i> ${val.title}</li>
															<li><i class="fa fa-clone"></i> ${val.house_type}</li>
															${val.estate_id > 0 ? '<li><i class="fa fa-list-ul"></i>'+ val.estate+
																	'(<span>'+ val.units+ 'Units</span>)</li>'        
															: ''}
														</ul>
													</div>
												</a>
												<hr>
												<div class="house__details__lower">
													<div class="house__details__lower__rs text-capitalize">
														For ${val.status}
													</div>
													<div class="house__details__lower__cl">
														<span><i class="far fa-heart"></i>  ${val.house_likes}</span>
													</div>
												</div>
											</div>
										</div>
									</div>`;


					})

				}
						
				$('#total-houses').val(data.total_houses);
				//alert(data.total_houses);
				$('#displayed-houses').val(data.displayed_houses);
				$('#db-content').html(output);
				hideFiltering();
			}
		});
	});
});