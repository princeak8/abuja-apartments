<h4>House Portfolio <span class="fa fa-angle-right"></span>
	<a href="{{url('realtor/add_house')}}"> 
    	<small class="smll">Add House <span class="fa fa-plus-square"></span></small>
    </a>
</h4>

<ul class="nav nav-tabs">
    <li class="active" data-id="available">
    	<a href="javascript:void(0)"> <span class="fa fa-bookmark"></span> Available Houses</a>
    </li>
    <li data-id="unavailable">
    	<a href="javascript:void(0)"><span class="fa fa-bookmark-o"></span> Unavailable Houses</a>
    </li>
    <li data-id="shared">
    	<a href="javascript:void(0)"><span class="fa fa-share-square"></span> My Shared Houses</a>
    </li>
</ul>

@if(request()->session()->exists('success'))
	<p class="alert-success">{{session('success')}} </p>
@endif

@if($realtor->type=='company') { ?>
	<ul class="nav nav-pills">
        <li class="filter" data-filter="all">
            <a href="javascript:void(0)">All Houses</a>
        </li>
        <li class="filter" data-filter="estate">
            <a href="javascript:void(0)">Estate Houses</a>
        </li>
        <li class="filter" data-filter="non-estate">
            <a href="javascript:void(0)">Non-Estate Houses</a>
        </li>
    </ul>
@endif

<div id="portfolio-grid" class="">            
    <div id="available" class="col-md-12 col-sm-12 col-xs-12 houses">
    	@if($realtor->Allhouses->count()==0) 
            <p> No Houses yet under this portfolio </p>
        @else
            <ul class="no-padding">
            	@foreach($realtor->Allhouses as $realtorHouse) 
            		<div class="col-md-3 col-sm-4 col-xs-6 cont_height">
                		<div class="house_container">
                			<li class="@if($realtorHouse->house->estate_id>0) estate @else non-estate @endif">
                				<div class="col-md-12 col-sm-12 img1 no-padding">
                					<a href="{{url('realtor/house/'.$realtorHouse->house_id)}}">
	                					@if(App\House_photo::GetMainPhoto($realtorHouse->house_id)->count())
	                                        <img src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetMainPhoto($realtorHouse->house_id)->first()->photo}}" />
	                                    @elseif(App\House_photo::GetHousePhotos($realtorHouse->house_id)->count())
	                                        <img src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetHousePhotos($realtorHouse->house_id)->first()->photo}}" />
	                                    @else
	                                        <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
	                                    @endif
                    				</a>
                				</div>
                				<div class="col-md-12 col-sm-12 col-xs-12 no-padding"> 
	                    			<b> <span class="fa fa-bed"></span> 
		                    			{{$realtorHouse->house->bedrooms}} Bedroom {{$realtorHouse->house->house_type->type}}
		                    			@if($realtorHouse->sharer_id > 0) 
		                    				<i class="">(Shared <span class="fa fa-share-square"></span>) </i>
		                    			@endif
		                    			<br/>
		                    			<span class="fa fa-map-marker"></span> {{$realtorHouse->house->location->name}}
		                    			<span class="pull-right cap_1st re">For {{$realtorHouse->house->status}}</span>
		                    			<br/>
	                    			</b>
                    				<div class="no-margin lvd text-center">
                    					<!--<a href="index.php?page=house likes&house_id=<?php //echo $house->house_id; ?>">--> 
                    						<span class="fa fa-thumbs-up"></span> Likes [{{$realtorHouse->house->likes}}]&nbsp;&nbsp;
                    					<!--</a>-->
                    					<a href="{{url('realtor/house/'.$realtorHouse->house_id)}}"> 
                    						<i class="fa fa-eye"></i> View
                    					</a> &nbsp;&nbsp; 
                    					@if($realtorHouse->sharer_id == 0)
											<a href="{{url('realtor/delete_house/'.$realtorHouse->house_id)}}" onClick="return confirm('Are You Sure You Want To Delete This House?')"> <i class="fa fa-trash-o"></i> Delete</a>
										@endif
                    				</div>
                				</div>
                			</li>
                			<div class="clear"></div>
                		</div>
            		</div> 
            	@endforeach
            </ul>
        @endif
        <div style="clear:both"></div>
        @if($realtor->Allhouses->count() > 0)
			<!--<div class="social">Share on:
				<a class="soc_fb" href="http://www.facebook.com/sharer.php?u=http://www.abujaapartments.com.ng/{{$realtor->profile_name}}" target="_blank" title="Click to share">
			   	<span class="fa fa-facebook"></span>
				</a>

				<a href="https://twitter.com/share" class="soc_tw twitter-share-button"{count} data-text="http://www.abujaapartments.com.ng/{{$realtor->profile_name}}" target="_blank" data-via="abujaapartments"><span class="fa fa-twitter"></span>
				</a>

				<a class="soc_wh" href="whatsapp://send?text=http://www.abujaapartments.com.ng/{{$realtor->profile_name}}" data-action="share/whatsapp/share"><span class="fa fa-whatsapp"></span>
				</a>
				<a class="soc_g" href="https://plus.google.com/share?url=http://www.abujaapartments.com.ng/{{$realtor->profile_name}}" target="_blank">
					<span class="fa fa-google-plus"></span>
				</a>
        	</div>-->
        @endif
    </div>
    <div id="unavailable" class="col-md-12 col-sm-12 houses">
    	<h4 class="blue"><span class="fa fa-bookmark-o"></span> Unavailable Houses</h4>
        @if($realtor->Unavailablehouses->count()==0)
    		<p> No Unavailable Houses </p>
    	@else
        <ul class="thumbnails row no-padding">
            @foreach($realtor->Unavailablehouses as $realtorHouse) 
    			<div class="col-md-3 col-sm-4 cont_height">
                    <div class="house_container">
    					<li class="mix @if($realtorHouse->house->estate_id>0) estate @else non-estate @endif" >
    						<div class="col-md-12 col-sm-12 img1 no-padding">
                        		<a href="{{url('realtor/house/'.$realtorHouse->house_id)}}">
                        			@if(App\House_photo::GetMainPhoto($realtorHouse->house_id)->count())
	                                    <img src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetMainPhoto($realtorHouse->house_id)->first()->photo}}" />
	                                @elseif(App\House_photo::GetHousePhotos($realtorHouse->house_id)->count())
	                                    <img src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetHousePhotos($realtorHouse->house_id)->first()->photo}}" />
	                                @else
	                                    <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
	                                @endif
                        		</a>
    						</div>

                     		<div class="col-md-12 col-sm-12 no-padding"> 	
                        		<b> <span class="fa fa-bed"></span>{{$realtorHouse->house->bedrooms}} Bedroom {{$realtorHouse->house->house_type->type}}
	                        		@if($realtorHouse->sharer_id > 0) 
			                    		<i class="">(Shared <span class="fa fa-share-square"></span>) </i>
			                    	@endif
			                    	<br/>
			                    	<span class="fa fa-map-marker"></span> {{$realtorHouse->house->location->name}}
			                    	<span class="pull-right cap_1st re">For {{$realtorHouse->house->status}}</span>
			                    	<br/>
                        		</b>
                        		<div class="no-margin lvd">
                        			<a href="{{url('realtor/house'.$realtorHouse->house_id)}}"> 
                    					<i class="fa fa-eye"></i> View
                    				</a>
                    				@if($realtorHouse->sharer_id == 0)
                       					<a href="{{url('realtor/delete_house/'.$realtorHouse->house_id)}}" onClick="return confirm('Are You Sure You Want To Delete This House?')"> <i class="fa fa-trash-o"></i> Delete</a>
                       				@endif
                       			</div>
    						</div>
                    	</li>
                    	<div class="clear"></div>
                    </div>
            	</div>   
    		@endforeach
        </ul> 
        @endif
    </div>
    
</div>

<div id="shared" class="houses">
	<h4><span class="fa fa-share-square"></span> My Shared Houses</h4>
    @if($realtor->mySharedHouses->count() == 0) {
		<p> You Have no Shared Houses </p>
	@else
    
    <div class="table-responsive no-margin table1">
		<table class="table table-responsive">
			<thead>
                <th class="h4 col-sm-1">S/N</th>
                <th class="h4 col-sm-7 col-xs-6">House(s)</th>
                <th class="h4 col-sm-4 col-xs-6">Shared With</th>
			</thead>
            <?php $n = 0; ?>
            @foreach($realtor->sharedHouses as $realtorHouse) <?php $n++; ?>
                <tbody>
                	<td class="col-sm-1 no-padding size">{{$n}}</td>
                    <td class="col-sm-7 col-xs-6">
                        <div class="col-sm-6 no-padding shared_img">
                            @if(App\House_photo::GetMainPhoto($realtorHouse->house_id)->count())
	                            <img class="img-rounded" src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetMainPhoto($realtorHouse->house_id)->first()->photo}}" />
	                        @elseif(App\House_photo::GetHousePhotos($realtorHouse->house_id)->count())
	                            <img class="img-rounded" src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetHousePhotos($realtorHouse->house_id)->first()->photo}}" />
	                        @else
	                            <img class="img-rounded" src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
	                        @endif
                        </div>
                        <p class="col-sm-6 share_p">
                            House Information<br>
                            <span class="fa fa-bed"></span> {{$realtorHouse->house->title}}<br/>
                            <span class="fa fa-map-marker"></span> {{$realtorHouse->house->location->name}}
                        </p>
                    </td>
                    <td class="col-sm-4 col-xs-6 xs_small">
                       <div class="sh_img_sm shadow1">
                        <div class="shared_imgs col-sm-5">
                            <img class="img-responsive" src="{{env('APP_STORAGE')}}images/profile_photos/{{$realtorHouse->realtor->profile_photo}}" />
                        </div>
                        <div class="col-sm-7 no-padding re">
                            <h5><span class="hidden-xs fa fa-angle-double-right"></span> {{$realtorHouse->realtor->name}}</h5>
                        </div>
                        <div class="clear"></div>
                       </div>
                    </td>
                </tbody>
            @endforeach
        </table>
    </div>
	@endif

</div>