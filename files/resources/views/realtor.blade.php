{{-- @extends('layouts.public', ['page'=>'view house']) --}}

@extends('layouts.frontpage')

@section('content')
	@include('inc.public.frontpage.houses_components.filtering')

<!-- The Left-side with the FILTERS starts here -->
<div class="col-lg-2 filter_container hideFilter"> 
	@include('inc.public.filters')
</div>

<div class="col-lg-7">

	<!-- The content containing the houses starts here -->
	<div class="" id="content">
	{{--@include('inc.public.frontpage.realtor_page.estate_houses')--}}
		
		{{-- <h6 class="text-center">Houses</h6> --}}
	    <div class="row" id="db-content">
			
	    	@foreach($realtor_houses as $realtor_house)
	    		<?php $house = $realtor_house->house; ?>
	    		{{-- <div class="col-lg-4 px-2">
	        		<div class="house">
						<div class="house__upper">
							<div class="house__upper__location">
								<span class="fa fa-map-marker-alt"></span> {{$house->location->name}}
								@if($house->estate_id > 0 && $house->estate) 
									(<span> {{shorten_location_name($house->estate->name)}}</span>)
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
					
				</div> --}}

				<div class="col-lg-4 col-sm-6 px-3">
                    {{-- <a href="house/{{$house->id}}"> --}}
                    <div class="house mouseoverHouse">  
                        <div class="cover"></div>
                        <div class="house__upper"> 
                            <div class="house__upper__location">
                                <span class="fa fa-map-marker-alt"></span> 
                                {{$house->location->name}}
                                @if($house->estate_id > 0)
                                    (<span> {{shorten_location_name($house->estate->name)}} </span>)
                                @endif
                            </div>

                            <div class="house__upper__img_price">
                                @include('inc.public.frontpage.houses_components.house_image')

                                <div class="house__upper__img_price__price">
                                    ₦ {{number_format($house->price)}} 
                                </div>
                            </div>

                            @include('inc.public.frontpage.houses_components.rooms_details')
                        </div>
                        
                        @include('inc.public.frontpage.houses_components.lower_details')
                        
                    </div>
                    {{-- </a> --}}
                </div>
				
	    	@endforeach

			<div class="spinnerContainer" id="loading">
				<div class="spinner"></div>
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
				<input id="realtor-id" type="hidden" value="{{$realtor->id}}" />
<!-- Ajax Control Variables ends here  -->

@endsection

@section('js') 

<script>

    function hoverEffect() {
        $('.mouseoverHouse').each(function(){
            var cover = $(this);
            $(this).find('a').not('a.delete').mouseover(function() {
                cover.find('.cover').css({
                    'height': '98%'
                });
                cover.find('.mouseoverDetails a').css({
                    'color': 'white'
                })
            })
            $(this).mouseleave(function() {
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

    function checkStringLength(string, estate=false) {
        let stringLength;
        if (estate) {
            stringLength = 15;
        } else {
            stringLength = 35;
        }
        const str = string.length;
        if (str >= stringLength) {
            // $substring = substr($string,0,$stringLength);
            // $space = strrpos($substring,' ');
            // return substr($string,0,$space)." <strong> ...</strong>";

            return `${string.slice(0, stringLength)}..`
        } else {
            return string;
        }
	}
	
	$('#realtorDetails').click(function() {
		if($('.drawOutDetails').hasClass('collapseFilterDetails')) {
			$('.drawOutDetails').removeClass('collapseFilterDetails')
			$('.drawOutDetails').addClass('collapseFilterDetailsActive')
		} else {
			$('.drawOutDetails').removeClass('collapseFilterDetailsActive')
			$('.drawOutDetails').addClass('collapseFilterDetails')
		}
		if($(this).hasClass('hideDetails')) {
			$(this).removeClass('hideDetails')
			$(this).addClass('showDetails')
		} else {
			$(this).removeClass('showDetails')
			$(this).addClass('hideDetails')
		}
	})

</script>

<script type="application/javascript" src="{{asset('js/filter_realtor_houses.js')}}"></script>

 <script type="application/javascript">
		hoverEffect();
		function showLoading() {
			$('#loading').css('display', 'flex');
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
									if(val.bathrooms == undefined || val.bathrooms == null){
                                        val.bathrooms = '';
                                    }
                                    if(val.bedrooms == undefined || val.bathrooms == null){
                                        val.bedrooms = '';
                                    }
                                    if(val.toilets == undefined || val.bathrooms == null){
                                        val.toilets = '';
                                    }
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
														<div class="house__upper__img_price__img ">
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
															<li><i class="fa fa-tag"></i> ${checkStringLength(val.title)}</li>
															<li><i class="fa fa-clone"></i> ${checkStringLength(val.house_type)}</li>
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


    @include('inc.public.circle_request_js')
@endsection

