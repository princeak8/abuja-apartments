@extends('layouts.public', ['page'=>'view house'])

@section('content')

<!-- The Left-side with the FILTERS starts here -->
<div class="col-md-2 col-sm-2 no-padding"> 
	@include('inc.public.filters')
</div>

<div class="col-md-7 col-sm-7 no-padding">

	<div class="container-fluid cont_real">

		<div class="realtor_pag">
	    	<div class="col-sm-1 col-xs-2 realtor_img">
               @if(!empty($realtor->profile_photo)) 
                <a data-lightbox="example-1" data-lightbox="example-1" href="images/profile_photos/{{$realtor->profile_photo}}">
                 <img src="images/profile_photos/{{$realtor->profile_photo}}" class="img-rounded img-responsive" />
                </a>
               @else
                <a data-lightbox="example-1" data-lightbox="example-1" href="">
                	<span class="fa fa-user"></span>
                </a>	
               @endif
                <script src="{{asset('js/lightbox.js')}}"></script>
            </div>

	        <div class="no-margin col-sm-11 col-xs-10 realtor_name no-padding">
	        	<h4>
		            @if($realtor->type == 'company') 
		            	{{$realtor->biz_name}} <i class="fa fa-angle-right"></i> Company Page
		            @else 
		            	{{$realtor->name}}<i class="fa fa-angle-right"></i>  Realtor Page 
		            @endif
	            </h4>

		        <!-- The follow starts here -->
		        <div class="col-sm-7 col-xs-12 fol">
					<div class="">
						@if(Auth::user())
							@if(Auth::user()->type != 'company' && Auth::user()->id != $realtor->id)
								<!-- If user is NOT following this realtor -->
								@if(!$realtor->is_follower(Auth::user()->id))
									<form action="processes/follow.php" method="post" style="display:inline-block;">
					                    <input type="hidden" name="followed" value="{{$realtor->id}}" />
					                    <input type="hidden" name="follower" value="{{Auth::user()->id}}" />
					                    <button  class="btn-info" type="submit" name="submit" value="Follow This Realtor" ><span class="fa fa-user-plus"></span> Follow This Realtor</button>
					                    <!--<input type="submit" name="submit" value="Follow This Realtor" />-->
					                </form>
								@endif
								<!-- If user is following this realtor -->
								@if($realtor->is_follower(Auth::user()->id))
									<form action="processes/unfollow.php" name="unfollow" method="post" style="display:inline-block">
					                    <input type="hidden" name="follow_id" value="{{App\Follower::getFollow($realtor->id, Auth::user()->id)->id}}" />
					                    <button class="btn-danger" id="unfollow" type="submit" name="submit" value="Unfollow" ><span class="fa fa-user"></span><span class="fa fa-minus"></span> Unfollow</button>
					                    <!--<input class="btn-danger" id="unfollow" type="submit" name="submit" value="Unfollow" />-->
					               </form>
								@endif
							@endif
							<?php/* Conditions
									if the realtor is logged in
									if the realtor logged in is not looking at his own realtor page
									if the realtor logged in is activated
									if the realtor is already in the loggedin realtor page
							*/?>
							<div id="circle-request" style="display:inline-block;">
								@if(Auth::user()->id != $realtor->id && Auth::user()->activated==1 && Auth::user()->rship_exists($realtor->id))
									@if(Auth::user()->request_sent($realtor->id))
										<b class="green">Circle Request Sent | </b>
									@endif
								@else
									<div style="display:inline-block;">
										<button type="button" id="add-to-circle-btn" class="btn-default" data-loading="0" data-accepter="{{$realtor->id}}"><span class="fa fa-rss"></span> Add to Circle</button>
										<!--<input type="submit" name="submit" value="Add to Circle" />-->
									</div>
								@endif 
							</div>
						@endif
						<b class="">
					        Followers <span class="label label-info">{{$realtor->followers->count()}}</span>
					    </b>
					</div>
				</div><!-- The follow ends here -->

				<div class="col-sm-5 col-xs-12 share_realtor">
			    	@include('inc.public.share')
				</div>

			</div>
			<div class="clear"></div>

		</div>
	</div>

	<!-- The content containing the houses starts here -->
	<div class="col-md-12 no-padding shadow1" id="content">
		@if($realtor->type=='company') 
			<div class="col-md-12">
				@foreach($realtor->estates as $estate) 
					<div class="col-md-3 col-sm-3 col-xs-6 no-padding est_xs">
						<div class="est_img">
							<a href="{{url('estate/'.$estate->id)}}">
								@if(App\House_photo::GetMainPhoto($estate->id)->count())
									<img class="img-responsive img-thumbnail" src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{App\Estate_photo::GetMainPhoto($estate->id)->first()->photo}}" /><br/>
								@elseif(App\Estate_photo::GetEstatePhotos($estate->id)->count())
									<img class="img-responsive img-thumbnail" src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{App\Estate_photo::GetEstatePhotos($estate->id)->first()->photo}}" />
								@else
                                    <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
                                @endif
							</a>
						</div>
					
						<div class="est_des">
							<p><span class="fa fa-tag"></span> {{$estate->name}}
							<br/>
							<span class="fa fa-map-marker"></span> {{$estate->location->name}}
							</p>
							<p class="no-padding">
								<a href="{{url('estate/'.$estate->id)}}"><span class="fa fa-eye"></span> View</a>
					   		</p>
					   	</div>
					</div>
				@endforeach
			</div>
		@endif

		<div id="filtering" style="width:100%; height:50px; text-align:center; display: none;">
	    	<img src="images/ajax-loader.gif" width="32" height="32" />
	        <br/>
	        <b>.....Be Patient While Houses are filtered......</b>
	    </div>

	    <div class="container-fluid no-padding" id="db-content">
	    	@foreach($realtor_houses as $realtor_house)
	    		<?php $house = $realtor_house->house; ?>
	    		<div class="col-xs-6 col-md-4 col-sm-6 cont_xs2">
	        		<div class="house_cont cont_xs1">
	        			<div class="locat">
		                	<span class="fa fa-map-marker"></span> {{$house->location->name}}
		                    @if($house->estate_id > 0 && $house->estate) 
		                    	(<span> Estate House</span>)
		                    @endif
		                </div>
		                <div class="col-xs-12 col-sm-12 no-padding">
				        	<a href="{{url('house/'.$house->id)}}">
					        	<div class="img">
					        		@if(App\House_photo::GetMainPhoto($house->id)->count())
                                        <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetMainPhoto($house->id)->first()->photo}}" />
                                    @elseif(App\House_photo::GetHousePhotos($house->id)->count())
                                        <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetHousePhotos($house->id)->first()->photo}}" />
                                    @else
                                        <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
                                    @endif
					            </div>
					        </a>
					    </div> 
					    <div class="price">₦{{number_format($house->price)}}</div> 
					    <div class="no-padding bath bath_re">
		                	<ul class="no-margin no-padding">
		                		<li><span class="fa fa-bed"></span> {{$house->bedrooms}} 
		                			{{($house->bedrooms <= 1) ? 'bedroom' : 'bedrooms'}}
		                		</li>
		                		<li><span class="fa fa-shower"></span> {{$house->bathrooms}}
		                			{{($house->bathrooms <= 1) ? 'bathroom' : 'bathrooms'}}
		                		</li>
		                		<li><span class="fa fa-bath"></span> {{$house->toilets}} 
		                			{{($house->toilets <= 1) ? 'toilet' : 'toilets'}}
		                		</li>
		                		<div class="clear"></div> 
		                	</ul>
		                </div> 
		                <div class="col-sm-12 col-xs-12 cont_descript">
				            <div class="descript">
				            	<ul class="no-padding">
					            	<li><span class="fa fa-tag"></span>{{$house->title}}</li>
					                <li><span class="fa fa-clone"></span>{{$house->house_type->type}}
						                @if($house->estate_id > 0 && $house->estate)
						                    <li><span class="fa fa-list-ul"></span> {{$house->estate->name}}
			                                    (<span>{{$house->units}} Units</span>)
			                                </li>  
						                @endif
					                </li>
					                <div class="clear"></div>
				            	</ul>
					                
				                <a href="{{url('house/'.$house->id)}}"><span class="fa fa-external-link"></span> View details <span class="fa fa-angle-double-right"></span> </a>       
				            </div>
				            <div class="cont_lik col-sm-12 col-xs-12">
						        <hr>
						         <p class="pull-left">For {{$house->status}}</p>
			                     <div class="pull-right">
			                        <i><span class="fa fa-thumbs-up"></span> Likes [{{$house->likes}}]</i>
			                     	<i><span class="fa fa-comments"></span> Comments [{{$house->house_comments->count()}})]</i>

			                     </div>
				        	</div>
				        
				        </div><!--End of Cont_descript -->
				        <div class="clear"></div>  
	        		</div><!-- Class house_cont ends here -->
	        	</div><!-- Class col-md-4 containing the house_cont class ends here -->
	    	@endforeach

	    	<div id="loading" style="text-align:center; display:none;" class="clear">
	            ...LOADING...
	        	<img src="images/spinner4.gif" width="72" height="50" />
	        </div>

	    </div><!-- id='db-content' ends here -->

	</div><!-- The content containing the houses ends here -->
</div>

<!-- Ajax Control Variables -->
           <input id="total-houses" type="hidden" value="{{$allRealtor_houses->count()}}" />
           <input id="displayed-houses" type="hidden" value="{{$realtor_houses->count()}}" />
           <input id="limit" type="hidden" value="{{$limit}}" />
		<!-- Ajax Control Variables ends here  -->

<div class="col-md-3 col-sm-3 col-xs-12 sm_xs">    
	<div class="col-sm-12 no-padding" id="realtor-details">
		<div class="container-fluid">   	
		    <div class="col-md-3 col-xs-4 no-padding"><b>Name : </b></div>
		    <div class="col-md-9 col-xs-8 no-padding">
		    	@if($realtor->type=='company') {{$realtor->biz_name}} @else {{$realtor->full_name}} @endif
		    </div>
		</div>
		<div class="container-fluid">       
		    <div class="col-md-4 col-xs-4 no-padding"><b style="font-stretch:condensed;">Realtor Type : </b></div>
		    <div class="col-md-8 col-xs-8 no-padding cap_1st">{{$realtor->type}}</div>
		</div> 
		<div class="container-fluid">       
		    <div class="col-md-2 col-xs-4 no-padding"><b>Email : </b></div>
		    <div class="col-md-10 col-xs-8 no-padding">{{$realtor->email}}</div>
		</div> 
		<div class="container-fluid">        
		    <div class="col-md-5 col-xs-4 no-padding"><b>No of Followers : </b></div>
		    <div class="col-md-7 col-xs-8 no-padding">{{$realtor->followers->count()}}</div>
		</div> 
		<div class="container-fluid">        
		    <div class="col-md-5 col-xs-4 no-padding"><b>No of Houses : </b></div>
		    <div class="col-md-7 col-xs-8 no-padding">{{$allRealtor_houses->count()}}</div>
		</div> 
		<div class="container-fluid">        
		    <div class="col-md-5 col-xs-4 no-padding"><b>Phone Number(s) : </b></div>
		    <div class="col-md-7 col-xs-8 no-padding">
		    	<?php $i = 0; ?>
				@foreach($realtor->phones as $realtorPhone)
					{{$realtorPhone->phone}} 
	            	<?php $i++; ?>

		            @if($i < $realtor->phones->count())
		                ,
		            @endif
		        @endforeach 
		    </div>
		</div>
		<div class="container-fluid">       
		    <div class="col-md-3 col-xs-4 no-padding"><b>Address : </b></div>
		    <div class="col-md-9 col-xs-8 no-padding">{{$realtor->address}}</div>
		</div> 
	</div>
</div>

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

@section('js') 
    @include('inc.public.circle_request_js')
@endsection
