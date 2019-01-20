$('#house-types h4').click(function(){
            $('.fold').slideToggle(function(){
            	if($(this).is(":hidden")){
            		$('#house-types h4 span.hi').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
            	}else{
            		$('#house-types h4 span.hi').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
            	}
            });
            
        });
        $('#bedrooms h4').click(function(){
            $('#no_room').slideToggle(function(){
            	if($(this).is(":hidden")){
            		$('#bedrooms h4 span.hi').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
            	}else{
            		$('#bedrooms h4 span.hi').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
            	}
            });
        });
        $('#price-ranges h4').click(function(){
            $('.fold_range').slideToggle(function(){
            	if($(this).is(":hidden")){
            		$('#price-ranges h4 span.hi').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
            	}else{
            		$('#price-ranges h4 span.hi').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
            	}
            });
        });
         

		function showLoading() {
			$('#loading').css('display', 'block');
		}
		function hideLoading() {
			$('#loading').css('display', 'none');
		}

		
		$(window).scroll(function() {
			
			if($(window).scrollTop() == $(document).height() - $(window).height()) {
				var total = $('#total-houses').val();
				var displayed = parseInt($('#displayed-houses').val()); 
				if(displayed < total) {
					showLoading();
					$.ajax({
						url: 'processes/load_houses.php',
						data: {displayed: displayed},
						type: 'post',
						async: false,
						error: function(XMLHttpRequest, textStatus, errorThrown) {
						  console.log(errorThrown);
						},
						success: function(data){ 
							var output = '';
							if(data.house == '') {
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
														output += '<img src="images/houses/'+val.house_id+'/thumbnails/'+val.photo+'" />';
													output += '</div>';
												output += '</a>'; 
											output += '</div>';
											
											//The Price tag
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
														output += ' <i><span class="fa fa-comments"></span> Comments['+val.comments+']</i>';
													output += '</div>';
												output += '</div>';//end of cont_lik

											output += '</div>';//end of cont_descript
		
											output += '<div class="clear"></div>';
		
										output += '</div>';//End of house_cont
		
									output += '</div>';	//End of cont_xs2
								})
		
							}
		
							hideLoading();
							$('#db-content').append(output);
							displayed = displayed + data.total_houses;
							$('#displayed-houses').val(displayed);
						}
					});
				}
			}
		});