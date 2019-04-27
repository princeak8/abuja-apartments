@extends('layouts.public', ['page'=>'view house'])

@section('content')

<!-- The Left-side with the FILTERS starts here -->
<div class="col-lg-2"> 
	@include('inc.public.filters')
</div>

<div class="col-lg-7">
	<div class="row">
		@include('inc.public.frontpage.realtor_page.realtor_top')
	</div>
	

	<!-- The content containing the houses starts here -->
	<div class="" id="content">
		@include('inc.public.frontpage.realtor_page.estate_houses')

		<div id="filtering" style="width:100%; height:50px; text-align:center; display: none;">
	    	<img src="images/ajax-loader.gif" width="32" height="32" />
	        <br/>
	        <b>.....Be Patient While Houses are filtered......</b>
		</div>
		
		<h6 class="text-center">Houses</h6>
	    <div class="row" id="db-content">
			
	    	@foreach($realtor_houses as $realtor_house)
	    		<?php $house = $realtor_house->house; ?>
	    		<div class="col-lg-4 px-2">
	        		<div class="house">
						<div class="house__upper">
							<div class="house__upper__location">
								<span class="fa fa-map-marker-alt"></span> {{$house->location->name}}
								@if($house->estate_id > 0 && $house->estate) 
									(<span> Estate House</span>)
								@endif
							</div>
							<div class="house__upper__img_price">
								@include('inc.public.frontpage.realtor_page.house_img') 
								
								<div class="house__upper__img_price__price">
									₦ {{number_format($house->price)}}
								</div>
							</div>
							
							@include('inc.public.frontpage.realtor_page.room_details') 
						</div>

		        @include('inc.public.frontpage.realtor_page.lower_details')
				         
					</div>
					
				</div>
				
	    	@endforeach

	    	<div id="loading" style="text-align:center; display:none;" class="clear">
	            ...LOADING...
	        	<img src="images/spinner4.gif" width="72" height="50" />
	        </div>

	    </div><!-- id='db-content' ends here -->

	</div><!-- The content containing the houses ends here -->
</div>

<div class="col-lg-3">

	@include('inc.public.frontpage.realtor_page.realtor_info_right')

</div>

<!-- Ajax Control Variables -->
           <input id="total-houses" type="hidden" value="{{$allRealtor_houses->count()}}" />
           <input id="displayed-houses" type="hidden" value="{{$realtor_houses->count()}}" />
           <input id="limit" type="hidden" value="{{$limit}}" />
		<!-- Ajax Control Variables ends here  -->



<script type="application/javascript" src="{{asset('js/filter_realtor_houses.js')}}"></script>
 
 <script type="application/javascript">
		function showLoading() {
			$('#loading').css('display', 'block');
		}
		function hideLoading() {
			$('#loading').css('display', 'none');
		}

	function test()
 	{
 		alert('ScrollTop: '+Math.ceil($(window).scrollTop())+' DocumentHeight - WindowHeight: '+ (Math.ceil($(document).height() - $(window).height())));
 	}
		loadingDone = true;
		$(window).scroll(function() { 
			//if($(window).scrollTop() == $(document).height() - $(window).height()) {
			if(Math.ceil($(window).scrollTop()) == Math.ceil($(document).height() - $(window).height())) {
				//alert(loadingDone);
				if(loadingDone) {
					loadingDone = false;
			
				var total = $('#total-houses').val();
				var displayed = parseInt($('#displayed-houses').val()); 
				/*if(displayed=='') {
					displayed = limit;
				}*/
				if(displayed < total) { 
					showLoading();
					//alert(displayed);
					//alert(total);
					$.ajax({
						url: 'processes/load_realtor_houses.php',
						data: {displayed: displayed},
						type: 'post',
						//async: false,
						error: function(XMLHttpRequest, textStatus, errorThrown) {
						  console.log(errorThrown);
						  loadingDone = true;
						},
						success: function(data){ //alert(data);
							var output = '';
							if(data.house == '') {
								output += '<h4><b class="h4 h4-xs">No Results for the Selected Filter</b></h4>';
							}else{
								//alert(data.house);
								$.each(data.house, function(key, val) {
									if(val.bathrooms == undefined){
										val.bathrooms = '';
									}
									if(val.bedrooms == undefined){
										val.bedrooms = '';
									}
									if(val.toilets == undefined){
										val.toilets = '';
									}
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
											output += '<div class="col-sm-12 col-xs-12 no-padding">';
												output += '<a href="index.php?page=view house&house_id='+val.house_id+'">';
													output += '<div class="img">';
														output += '<img src="images/houses/'+val.house_id+'/thumbnails/'+val.photo+'" />';
													output += '</div>';
												output += '</a>';
											output += '</div>';
											
											//The Price tag
											output += '<div class="price">';
												output += '₦ '+val.price;
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
														output += '<li><span class="fa fa-tag"></span> '+val.title+'</li>';
														output += '<li><span class="fa fa-clone"></span> '+val.house_type+'</li>';
														if(val.estate != '') { 
															output += '<li><span class="fa fa-list-ul"></span> '+val.estate+' Estate';
															output += '<span>('+val.units+' Units)</span>';
															output += '</li>';
														} 
													output += '</ul>';	
													output += '<a href="index.php?page=view house&house_id='+val.house_id+'"><span class="fa fa-caret-right"></span> View details <span class="fa fa-angle-double-right"></span> </a>';
													
												output += '</div>';

												//Cont_lik starts
												output += '<div class="cont_lik col-sm-12">';
													output += '<hr/>';
													output += '<p class="pull-left">';	
														output += 'For '+val.status;
													output += '</p>';
			
													output += '<div class="pull-right">';
														output += '<i><span class="fa fa-thumbs-up"></span> Likes['+val.house_likes+']</i>';
														output += '<i><span class="fa fa-comments"></span> Comments['+val.comments+']</i>';
													output += '</div>';
												output += '</div>';//end of cont_lik
												
											output += '</div>';//end of cont_descript col-md-12
		
										output += '<div class="clear"></div>';	
		
										output += '</div>';//End of house_cont
		
									output += '</div>';	//End of cont_xs2
								})
		
							}
								/*output += '<div class="clear">';
								output += '</div>';	
							output += '</div>';*/	
							//alert(output);
							hideLoading();
							$('#db-content').append(output).fadeIn(10000);

							//alert(data.total_houses);
							displayed = displayed + data.total_houses;
							$('#displayed-houses').val(displayed);
							loadingDone = true;
							//alert(displayed);
						}
					});
				}
			  }//loading done
			}
		});
	</script>

@endsection