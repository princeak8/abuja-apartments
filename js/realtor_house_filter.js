$(document).ready(function(e) { 
            $('form[name=unfollow]').submit(function(e) {
				if(confirm("Are You Sure You want to Unfollow this Realtor?")) {
					return true;
				}else{
                	return false;
				}
            });
        });
	</script>
 <!--<script type="application/javascript" src="js/realtor_houses_filter.js"></script>-->
 <script type="application/javascript">
	// JavaScript Document
	function showFiltering() {
		$('#filtering').css('display', 'block');
	}
	function hideFiltering() {
		$('#filtering').css('display', 'none');
	}
$(document).ready(function(e) { 
		$('#left-side select').change(function(e) {
			showFiltering();
		var value = $(this).val();
		var filter = $(this).attr('name');
		var title = $(this).children(":selected").data("id");
		var checked = 1;
		
	 	$.ajax({
				url:"processes/filter_realtor_houses.php", 
				data:{filter: filter, value: value, title: title, checked: checked}, 
				type: "post", 
				async: false,
				error: function(XMLHttpRequest, textStatus, errorThrown) {
				  console.log(errorThrown);
				}, 
				success: function(data) { 
					//alert(data);
					var output = '';
					output += '<div class="container-fluid no-padding">';
					if(data.title != '') {
						output += '<div class="col-md-12 sub no-padding">';
						output += '<h4 class="col-md-4 h5">FILTERS ON: <i class="fa fa-angle-right"></i>  ';
						$.each(data.title, function(key, title) {
							//output += '<i>'+title+' </i> | ';
							output += '<b>'+key+':</b> ';
							$.each(title, function(key, title) {
								output += '<i>'+title+'</i>, ';
							});
							output += ' | ';
						});
						output += '</h4>';
						output += '</div>';
					}
					if(data.house == '') {
						output += '<h4><b class="h4 h4-xs">No Results for the Selected Filter </b></h4>';
					}else{
						$.each(data.house, function(key, val) {
							output += '<div class="col-xs-6 col-md-3 col-sm-4 cont_xs2">';
								output += '<div class="container house_cont cont_xs1">';

									//output += '<div class="col-md-12" style="margin-bottom:10px;">';
									//output += '<p class="pull-right" style="font-size:14px; color:#0066CC;">';
									//output += '<b>';
									// output += val.status;
									// output += '</b>';
									//output += '</p>';
									output += '<div class="col-md-12 no-padding">';
										output += '<a href="index.php?page=view house&house_id='+val.house_id+'">';
											output += '<div class="row img">';
											//output += '<img src="images/houses/'+val.house_id+'/'+val.photo+'" width="250" height="150" />';
											output += '<img src="images/houses/'+val.house_id+'/thumbnails/'+val.photo+'" />';
											output += '</div>';
										output += '</a>';	
									output += '</div>';

									output += '<div class="price">';
									output += 'N'+val.price;
									output += '</div>';

									output += '<div class="col-sm-12 col-xs-12">';
										output += '<div class="row descript">';
											//output += '<div class="col-md-4" style="font-size:16px; margin-top:30px;">';
											output += '<ul class="no-padding">';	
												output += '<li><span class="fa fa-caret-right"></span> '+val.location+'</b>';
												if(val.estate != '') { 
													output += '<span>('+val.estate+' Estate</span>)';
												} 
												output += '</li>';
												output += '<li><span class="fa fa-caret-right"></span> '+val.title+'</li>';
												if(val.estate != '') { 
													output += '<li><span class="fa fa-caret-right"></span> '+val.estate+' Estate';
													output += '<span>('+val.units+' Units)</span>';
													output += '</li>';
												} 
												// output += '<b>'+val.house_type+'</b><br/>';
												// output += '<b>'+val.bedrooms+' bedrooms</b>';
												output += '<li><span class="fa fa-caret-right"></span> '+val.house_type+' (';
												output += val.bedrooms;
												if(val.bedrooms <= 1){
													output += ' Bedroom )</li>';
												}else{
													output += ' Bedrooms )</li>';
												}
												
												// output += '<br/>';
												// output += '<b class="sal">';
												// output += 'For '+val.status;
												// output += '</b>';
												// output += '<br/>';
												output += '<a href="index.php?page=view house&house_id='+val.house_id+'"><span class="fa fa-caret-right"></span> View details  <span class="fa fa-angle-double-right"></span> </a>';
											output += '<ul>';
										output += '</div>';
										//output += '<hr/>';
									output += '</div>';//end of col-md-12

									output += '<div class="cont_lik col-sm-12">';
										output += '<hr/>';
										output += '<p class="pull-left">';	
											output += 'For '+val.status;
										output += '</p>';

										output += '<div class="pull-right">';
	                        				output += '<i><span class="fa fa-thumbs-up"></span> Likes['+val.house_likes+']</i>';
											output += '<i><span></span> Comments['+val.comments+']</i>';
	                        			output += '</div>';
	                        		output += '</div>';	//end of cont_lik
									
								output += '</div>';
							output += '</div>';	
						})
					}
						output += '<div class="clear">';
						output += '</div>';

					output += '</div>';	//end of main container-fluid after the empty var
					//alert(output);
					$('#filtering').css('display', 'none');
					$('#content').html(output);
				}
			});
	});
		
        $('#left-side input').change(function(e) {
			showFiltering();
            var value = $(this).val();
			var filter = $(this).attr('name');
			var title = $(this).data('id');
			
			if($(this).is(":checked")) {
				var checked = 1;
				if(value != 'all') {
					$(this).siblings('input[type=radio]').prop('checked', false);
				}else{
					$(this).siblings('input[type=checkbox]').prop('checked', false);
				}	
			}else{
				//alert('unchecked');
				var checked = 0;
			}
			//alert(span);
			//alert('Filter: '+filter+'  Value: '+value+'  Title: '+title);
			$.ajax({
				url:"processes/filter_realtor_houses.php", 
				data:{filter: filter, value: value, title: title, checked: checked}, 
				type: "post", 
				async: false, 
				error: function(XMLHttpRequest, textStatus, errorThrown) {
				  console.log(errorThrown);
				},
				success: function(data) { 
					//alert(data.title);
					var output = '';
					output += '<div class="container-fluid no-padding">';
					if(data.title != '') {
						output += '<div class="col-md-12 sub no-padding">';
						output += '<h4 class="h5">FILTERS ON <i class="fa fa-angle-right"></i> ';
						$.each(data.title, function(key, title) {
							//output += '<i>'+title+' </i> | ';
							output += '<b>'+key+':</b> ';
							$.each(title, function(key, title) {
								output += '<i>'+title+'</i>, ';
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
								output += '<div class="container house_cont cont_xs1">';
									// output += '<div class="col-md-12" style="margin-bottom:10px;">';
									// output += '<p class="pull-right" style="font-size:14px; color:#0066CC;">';
									// output += val.status;
									// output += '</p>';
									output += '<div class="col-md-12 col-lg-12 no-padding">';
										output += '<a href="index.php?page=view house&house_id='+val.house_id+'">';
											output += '<div class="row img">';
											output += '<img src="images/houses/'+val.house_id+'/thumbnails/'+val.photo+'" />';
											output += '</div>';
										output += '</a>';
									output += '</div>';

									output += '<div class="price">';
										output += 'N '+val.price;
									output += '</div>';

									output += '<div class="col-md-12 col-xs-12">';
										output += '<div class="row descript">';
											output += '<ul class="no-padding">';	
												output += '<li><span class="fa fa-caret-right"></span> '+val.location;
												if(val.estate != '') { 
													output += '<span>('+val.estate+' Estate</span>)';
												} 
												output += '</li>';
												output += '<li><span class="fa fa-caret-right"></span> '+val.title+'</li>';
												if(val.estate != '') { 
													output += '<li><span class="fa fa-caret-right"></span> '+val.estate+' Estate';
													output += '<span>('+val.units+' Units)</span>';
													output += '</li>';
												} 
												output += '<li><span class="fa fa-caret-right"></span> '+val.house_type+' (';
												output += val.bedrooms;
												if(val.bedrooms <= 1){
													output += ' Bedroom )</li>';
												}else{
													output += ' Bedrooms )</li>';
												}
												//output += '<br/>';
												output += '<a href="index.php?page=view house&house_id='+val.house_id+'"><span class="fa fa-caret-right"></span> View details <span class="fa fa-angle-double-right"></span> </a>';
											output += '</ul>';		
										output += '</div>';
											//output += '<hr/>';
										
									output += '</div>';//end of col-md-12

									output += '<div class="cont_lik col-sm-12">';
										output += '<hr/>';
										output += '<p class="pull-right">';	
											output += 'For '+val.status;
										output += '</p>';

										output += '<div class="pull-right" style="font-size:12px">';
	                        		    output += '<i><span class="fa fa-thumbs-up"></span> Likes['+val.house_likes+']</i>';
										output += '<i><span></span> Comments['+val.comments+']</i>';
	                        			output += '</div>';
									output += '</div>';//end of cont_lik

								output += '</div>';

							output += '</div>';			
						})
					}
						output += '<div class="clear">';
						output += '</div>';
					output += '</div>';			
					//alert(output);
					$('#filtering').css('display', 'none');
					$('#content').html(output);
				}
			});
        });
    }); 