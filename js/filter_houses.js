// JavaScript Document
function hoverEffect() {
	$('.mouseoverHouse').each(function () {
		var cover = $(this);
		$(this).find('a').not('a.delete').mouseover(function () {
			cover.find('.cover').css({
				'height': '98%'
			});
			cover.find('.mouseoverDetails a').css({
				'color': 'white'
			})
		})
		$(this).mouseleave(function () {
			$(this).find('.cover').css('height', '0')
			$(this).find('.mouseoverDetails a').css({
				'color': '#636b6f'
			})
			$(this).find('.mouseoverDetails a.delete').css({
				'color': 'rgb(235, 65, 65)'
			})
		})
	})
}

function checkStringLength(string, estate = false) {
	let stringLength;
	if (estate) {
		stringLength = 15;
	} else {
		stringLength = 35;
	}
	const str = string.length;
	if (str >= stringLength) {
		return `${string.slice(0, stringLength)}..`
	} else {
		return string;
	}
}
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
				//console.log(data);
				//console.log(data.title);
				//data = JSON.parse(data); 
				/*try {
					data = JSON.parse(data); 
				}catch(e){
					console.log(e);
				}*/
				var output = '';
				
				if(data.title != '') {
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
				if(data.house === '' || data.house === undefined) {
					output += `<div class="emptyContainer">
						
						<div class="svgStyles">
							<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="box-open" class="svg-inline--fa fa-box-open fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
							<path fill="rgba(6, 94, 153, 1)" d="M425.7 256c-16.9 0-32.8-9-41.4-23.4L320 126l-64.2 106.6c-8.7 14.5-24.6 23.5-41.5 23.5-4.5 0-9-.6-13.3-1.9L64 215v178c0 14.7 10 27.5 24.2 31l216.2 54.1c10.2 2.5 20.9 2.5 31 0L551.8 424c14.2-3.6 24.2-16.4 24.2-31V215l-137 39.1c-4.3 1.3-8.8 1.9-13.3 1.9zm212.6-112.2L586.8 41c-3.1-6.2-9.8-9.8-16.7-8.9L320 64l91.7 152.1c3.8 6.3 11.4 9.3 18.5 7.3l197.9-56.5c9.9-2.9 14.7-13.9 10.2-23.1zM53.2 41L1.7 143.8c-4.6 9.2.3 20.2 10.1 23l197.9 56.5c7.1 2 14.7-1 18.5-7.3L320 64 69.8 32.1c-6.9-.8-13.5 2.7-16.6 8.9z">
							</path>
							</svg>
						</div>
						<p>No Results for the Selected Filter</p>
					</div>`;
				} else {
					$.each(data.house, function(key, val) {
						output += `<div class="col-xl-3 col-lg-4 col-sm-6 px-3">
								   		<div class="house mouseoverHouse">  
											<div class="cover"></div>
											<div class="house__upper"> 
												<div class="house__upper__location">
													<span class="fa fa-map-marker-alt"></span> ${val.location}
													${val.estate_id > 0 ? '(<span>'+ checkStringLength(val.estate, true)+ '</span>)' : ''}
												</div>
												<div class="house__upper__img_price">
													<a href="house/${val.house_id}">
														<div class="house__upper__img_price__img">
															<img src="${val.photo}" />
														</div>
													</a>
	
													<div class="house__upper__img_price__price">
														₦ ${val.price} 
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
															<li> <i class="fa fa-tag"> </i> ${checkStringLength(val.title)}</li>
															<li> <i class="fa fa-clone"> </i> ${checkStringLength(val.house_type)}</li>
															${val.estate_id > 0 ? '<li><i class="fa fa-list-ul"></i>'+ checkStringLength(val.estate, true)+
																	'(<span>'+ val.units+ ' Units</span>)</li>'        
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
				hoverEffect();
			}
		});
	});
});