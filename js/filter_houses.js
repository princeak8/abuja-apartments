// JavaScript Document
function showFiltering() {
	$('#filtering').css('display', 'flex');
}
function hideFiltering() {
	$('#filtering').css('display', 'none');
}
$(document).ready(function(e) { 
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

		var postUrl = APP_URL+"api/v1/filter_houses";
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
					output += '<div class="col-md-12">';
					output += '<h4 class="h5">FILTERS ON ';
					$.each(data.title, function(key, title) { 
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