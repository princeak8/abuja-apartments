@include('inc.public.frontpage.houses_components.filtering')
<div class="col-lg-10">    
    <div class="" id="content">
        {{-- @include('inc.public.frontpage.houses_components.filtering') --}}
        <div class="filterTags">
            
            <span>tags</span>
        </div>
        
        <div id="db-content" class="row">
            @foreach($houses as $house)  
      
                <!-- The House Pix and description starts here -->
                <div class="col-lg-3 col-sm-6 px-3">
                    {{-- <a href="house/{{$house->id}}"> --}}
                    <div class="house mouseoverHouse">  
                        <div class="cover"></div>
                        <div class="house__upper"> 
                            <div class="house__upper__location">
                                <span class="fa fa-map-marker-alt"></span> {{$house->location->name}}
                                @if($house->estate_id > 0)
                                    (<span> {{$house->estate->name}} </span>)
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
                
        <div id="loading" style="text-align:center; display:none">
            ...LOADING...
            <img src="{{env('APP_STORAGE')}}images/ajax-loader.gif" width="32" height="32" />
        </div>
    </div>

       
</div>

</div>
    
    <!-- Ajax Control Variables -->
           <input id="total-houses" type="hidden" value="{{count(App\House::all())}}" />
           <input id="displayed-houses" type="hidden" value="{{count($houses)}}" />
           <input id="limit" type="hidden" value="{{$limit}}" />
        <!-- Ajax Control Variables ends here  -->

@section('js')

<script>
	$(document).ready(function(){ 
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
		
	})
</script>
		


<script type="application/javascript" src="{{asset('js/filter_houses.js')}}"></script>

<script type="application/javascript">
function showLoading() {
            $('#loading').css('display', 'block');
        }
        function hideLoading() {
            $('#loading').css('display', 'none');
        }

        loadingDone = true;
        //const CSRF_TOKEN = $('input[name=_token]').val();
        $(window).scroll(function() {
            
            //if($(window).scrollTop() == $(document).height() - $(window).height()) {
            if(Math.ceil($(window).scrollTop()) == Math.ceil($(document).height() - $(window).height())) {
                //alert('load');
                if(loadingDone) {
                    loadingDone = false;

                var total = $('#total-houses').val();
                var displayed = parseInt($('#displayed-houses').val()); 
                //alert(total);
                /*if(displayed=='') {
                    displayed = limit;
                }*/
                if(displayed < total) { //alert('start loading');
                    showLoading();
                    var postUrl = "{{env('APP_URL').'/load_houses'}}";
                    var postFields = {displayed: displayed, _token: CSRF_TOKEN};
                    //alert(displayed);
                    //alert(total);
                    $.ajax({
                        url: postUrl,
                        data: postFields,
                        type: 'post',
                        //async: false,
                        error: function(xhr, textStatus, errorThrown) {
                          console.log(xhr.responseText);
                          //alert(xhr.responseText);
                        },
                        success: function(data){ //alert(data);
                            var output = '';
                            /*output += '<div class="container-fluid no-padding">';*/
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
                                    output += `<div class="col-lg-3 col-sm-6 px-3">
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
                                /*output += '<div class="clear">';
                                output += '</div>'; 
                            output += '</div>';*/   
                            //alert(output);
                            hideLoading();
                            $('#db-content').append(output);
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