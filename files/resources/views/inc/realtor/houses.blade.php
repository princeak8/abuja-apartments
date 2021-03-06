<h4 class="content__right__main__houses__portfolio">House Portfolio 
		{{-- <a href="{{url('realtor/add_house')}}"> 
    	Add House &nbsp;<i class="fa fa-plus"></i>
		</a> --}}
		<button type="button" href="#" data-toggle="modal" data-target="#exampleModal">
			Add House &nbsp;<i class="fa fa-plus"></i>
		</button>
</h4>


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="available-tab" data-toggle="tab" href="#available" role="tab" aria-controls="available" aria-selected="true">Available Houses</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="unavailable-tab" data-toggle="tab" href="#unavailable" role="tab" aria-controls="unavailable" aria-selected="false">Unavailable Houses</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="shared-tab" data-toggle="tab" href="#shared" role="tab" aria-controls="shared" aria-selected="false">My Shared Houses</a>
  </li>
</ul>

@if(request()->session()->exists('success'))
	<p class="alert-success">{{session('success')}} </p>
@endif

@if($realtor->type=='company')
<!--
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
	-->
@endif

<div class="tab-content houses__container" id="myTabContent">
	            
    <div id="available" class="tab-pane fade show active houses__container__available" role="tabpanel" aria-labelledby="available-tab">
    	@if($realtor->AllAvailableHouses->count()==0) 
					<p> No Houses yet under this portfolio </p>
		@else
			<div class="row">
				@foreach($realtor->AllAvailableHouses as $realtorHouse) 
					<div class="col-lg-4 col-xl-3 col-sm-6">
							
						<div class="houses__container__available__house @if($realtorHouse->house->estate_id>0) estate @else non-estate @endif mouseoverHouse">
							
							<a href="{{url('realtor/house/'.$realtorHouse->house_id)}}">
								<div class="houses__container__available__house__img">
									@if(App\House_photo::GetMainPhoto($realtorHouse->house_id)->count())
										<img src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetMainPhoto($realtorHouse->house_id)->first()->photo}}" />
									@elseif(App\House_photo::GetHousePhotos($realtorHouse->house_id)->count())
										<img src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetHousePhotos($realtorHouse->house_id)->first()->photo}}" />
									@else
										<img src="{{env('APP_STORAGE')}}images/no_image.png" alt="no-image" />
									@endif
								</div>
							</a>
							<div class="cover"></div>
							<div class="houses__container__available__house__details mouseoverDetails col-12 px-2">
								<a href="{{url('realtor/house/'.$realtorHouse->house_id)}}"> 
									<div class="houses__container__available__house__details__type">
										{{$realtorHouse->house->house_type->type}} &nbsp;&nbsp;
										@if($realtorHouse->sharer_id > 0) 
											<small>Shared <i class="fa fa-share"></i></small>
										@endif
									</div>
									<div class="houses__container__available__house__details__bl">
										<p><i class="fa fa-bed"></i> {{$realtorHouse->house->bedrooms}} Bedroom </p>
										<p><i class="fa fa-map-marker-alt"></i> {{$realtorHouse->house->location->name}}</p>
									</div>
								</a>
								<div class="houses__container__available__house__details__lower">
									<span class="rs">{{$realtorHouse->house->status}}</span>
									
									<span class="like">	
										<i class="far fa-heart"></i> {{$realtorHouse->house->likes}}
									</span>
									
									<span>
										<a href="{{url('realtor/edit_house/'.$realtorHouse->house_id)}}" title="edit house"> 
											<i class="fa fa-edit"></i> 
										</a>
									</span>
									@if($realtorHouse->sharer_id == 0)
									<span>
										<a href="{{url('realtor/delete_house/'.$realtorHouse->house_id)}}" class="delete" title="delete house"
											onClick="return confirm('Are You Sure You Want To Delete This House?')"> 
											<i class="fa fa-trash"></i> 
										</a>
									</span>
									@endif
								</div>
								@if($realtorHouse->sharer_id == 0)
									<?php $available = ($realtorHouse->available==1) ? "0" : "1"; ?>
									<div class="d-flex justify-content-center mb-2">
										<button 
											id="availability-btn" 
											class="btn btn-sm rounded-corner col-12 @if($available==0) btn-danger @else btn-success @endif" 
											data-available="{{$available}}" 
											data-id="{{$realtorHouse->house_id}}"
										>
											@if($available==0) 
												Mark as Unavailable 
											@else 
												Mark as Available 
											@endif
										</button>
									</div>
								@endif
							</div>
							
						</div>
									
					</div> 
				@endforeach
			</div>
      	@endif
        {{-- @if($realtor->Allhouses->count() > 0)
			<div class="social">Share on:
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
        	</div>
        @endif --}}
    </div>
    <div id="unavailable" class="tab-pane fade houses__container__available" role="tabpanel" aria-labelledby="unavailable-tab">
        @if($realtor->Unavailablehouses->count()==0)
    		<p> No Unavailable Houses </p>
    	@else
        <div class="row">
            @foreach($realtor->Unavailablehouses as $realtorHouse) 
    			<div class="col-lg-4 col-xl-3 col-sm-6">
					<div class="houses__container__available__house @if($realtorHouse->house->estate_id>0) estate @else non-estate @endif mouseoverHouse" >
						<a href="{{url('realtor/house/'.$realtorHouse->house_id)}}">
							<div class="houses__container__available__house__img">
								@if(App\House_photo::GetMainPhoto($realtorHouse->house_id)->count())
									<img src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetMainPhoto($realtorHouse->house_id)->first()->photo}}" />
								@elseif(App\House_photo::GetHousePhotos($realtorHouse->house_id)->count())
									<img src="{{env('APP_STORAGE')}}images/houses/{{$realtorHouse->house_id}}/thumbnails/{{App\House_photo::GetHousePhotos($realtorHouse->house_id)->first()->photo}}" />
								@else
									<img src="{{env('APP_STORAGE')}}images/no_image.png" alt="no-image" />
								@endif
								
							</div>
						</a>
						<div class="cover"></div>
						<div class="houses__container__available__house__details mouseoverDetails col-12"> 
							<a href="{{url('realtor/house/'.$realtorHouse->house_id)}}">
								<div class="houses__container__available__house__details__type">
									{{$realtorHouse->house->house_type->type}}
									@if($realtorHouse->sharer_id > 0) 
										<small>Shared <i class="fa fa-share-square"></i></small>
									@endif
								</div>
								<div class="houses__container__available__house__details__bl">
									<p><i class="fa fa-bed"></i> {{$realtorHouse->house->bedrooms}} Bedroom </p>
									<p><i class="fa fa-map-marker-alt"></i> {{$realtorHouse->house->location->name}}</p>
								</div>
							</a>	
							<div class="houses__container__available__house__details__lower">
								<span class="rs">{{$realtorHouse->house->status}}</span>
								@if($realtorHouse->sharer_id == 0)
								<span>
									<a href="{{url('realtor/delete_house/'.$realtorHouse->house_id)}}" class="delete"
										onClick="return confirm('Are You Sure You Want To Delete This House?')"> <i class="fa fa-trash"></i>
									</a>
								</span>
								@endif
							</div>
							@if($realtorHouse->sharer_id == 0)
								<?php $available = ($realtorHouse->available==1) ? "0" : "1"; ?>
								<div class="mb-2 d-flex justify-content-center">
									<button 
										id="availability-btn" 
										class="btn btn-sm col-12 rounded-corner @if($available==0) btn-danger @else btn-success @endif" 
										data-available="{{$available}}" 
										data-id="{{$realtorHouse->house_id}}"
									>
										@if($available==0) 
											Mark as Unavailable 
										@else 
											Mark as Available 
										@endif
									</button>
								</div>
							@endif
						</div>
					</div>
                    	
            	</div>   
    		@endforeach
        </div> 
        @endif
    </div>
	<div id="shared" class="tab-pane fade" role="tabpanel" aria-labelledby="shared-tab">
		@if($realtor->mySharedHouses->count() == 0)
			<p> You Have no Shared Houses </p>
		@else
		
		<div class="table-responsive no-margin table1">
			<table class="table table-bordered">
				<thead>
					<th class="h4 col-sm-1">S/N</th>
					<th class="h4 col-sm-7 col-xs-6">House(s)</th>
					<th class="h4 col-sm-4 col-xs-6">Shared With</th>
				</thead>
				<?php $n = 0; ?>
				@foreach($realtor->sharedHouses as $realtorHouse) <?php $n++; ?>
					<tbody>
						<td>{{$n}}</td>
						<td>
							<div class="col-sm-6 shared_img">
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
							<div class="">
								<div class="shared_imgs col-sm-5">
									<img class="img-responsive" src="{{env('APP_STORAGE')}}images/profile_photos/{{$realtorHouse->realtor->profile_photo}}" />
								</div>
								<div class="col-sm-7 re">
									<h5><span class="hidden-xs fa fa-angle-double-right"></span> {{$realtorHouse->realtor->name}}</h5>
								</div>
								
							</div>
						</td>
					</tbody>
				@endforeach
			</table>
		</div>
		@endif

	</div>
	@include('inc.realtor.add_house_modal')
</div>

@section('js')

<script>
	$(document).ready(function(){ 
		$('.mouseoverHouse').each(function(){
			var cover = $(this);
			$(this).find('a').not('a.delete').mouseover(function() {
				cover.find('.cover').css({
					'height': '100%'
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

		$(document).on('click', '#availability-btn', function(e) {
			var available = $(this).data('available');
			var make = (available == 1) ? 'Available?' : 'Unavailable?';
			if(confirm('Are You Sure You want to make this house '+make)) {
				var house_id = $(this).data('id');
				var postFields = {house_id: house_id, available: available, _token: CSRF_TOKEN};
				var postUrl = "{{url('realtor/change_house_availability')}}";
				//alert(available);
				$.ajax({
					url:postUrl, 
					data:postFields, 
					type: "post", 
					async: false, 
					success: function(data) { 
					//alert(data);
						window.location.href = APP_URL+"realtor/home";
					}
				}) 
			}
    	});
		
	})
</script>

@yield('modaljs')
		
@endsection