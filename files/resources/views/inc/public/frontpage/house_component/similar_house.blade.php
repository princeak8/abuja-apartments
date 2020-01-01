<div class="col-lg-3 similarContainer">
    <div class="similar">
        <div class="similar__heading">
    	   <h5 class="similar__heading__title">Similar Houses</h5>
        </div>
        <div class="similar__body">
	        @if($similar_houses->count()==0)
	    		No similar available house
	    	@else
	    	  	@foreach($similar_houses as $house) 
		        	<div id="similar-house" class="">
						<a href="{{url('house/'.$house->id)}}" class="row similar__body__house mouseoverHouse">
							<div class="cover"></div>
							<div class="col-4 pl-0 pr-0">
								
									<div class="similar__body__house__img">
										@if(App\House_photo::GetMainPhoto($house->id)->count())
											<img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetMainPhoto($house->id)->first()->photo}}" />
										@elseif(App\House_photo::GetHousePhotos($house->id)->count())
											<img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetHousePhotos($house->id)->first()->photo}}" />
										@else
											<img src="{{env('APP_STORAGE')}}images/no_image.png" />
										@endif
									</div>
								
							</div>
							<div class="col-8 pr-0">
								<ul class="similar__body__house__details m-0 pl-0 pr-2 mouseoverDetails">
									<li> {{$house->title}}</li>
									<li> - {{$house->house_type->type}}</li>
									<li> - {{$house->location->name}}</li>
									<li class="notli">₦ {{number_format($house->price)}}
										<span>
										@if($house->status=='rent')
											Per Annum
										@else
											For sale
										@endif
										</span>
									</li>
									
								</ul>
							</div>
						</a>

		            </div>
	        	@endforeach
	        @endif
        </div>
    </div>    
</div>