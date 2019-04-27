<div class="col-lg-6 px-1">

		<div class="vhouse_details">
			<div class="px-3 pt-2">
                @if($house->estate_id > 0) 
                    <h3 class="vhouse_details__estate_title">
                        <a href="index.php?page=view estate&estate_id={{$house->estate->id}}">
                            {{$house->estate->name}} 
                        </a>
                    </h3>
                @endif

                <h4 class="vhouse_details__house_title">House - {{$house->title}} </h4>
            </div>

            <div class="vhouse_details__second_header">
                <div class="col-lg-4 col-6">
                    <i class="fa fa-map-marker-alt"></i> {{$house->location->name}}
                </div>
                <div class="col-lg-6 col-6" >
                    <span> 
                        ₦{{number_format($house->price)}}
                        @if($house->status=='rent')
                            (Per Annum)
                        @endif
                    </span>
                </div>
                <div class="col-lg-2 col-12 text-capitalize">
                    <span>{{$house->status}}</span>
                </div>
            </div>
            <!--- Like Button for Registered Users  -->
            <div class="no-padding lik_un">

				{{-- @if(Auth::user() && !$realtorHouse->realtor->is_follower(Auth::user()->id))  --}}
				@if(Auth::user()) 
                    @if($house->liked(Auth::user()->id)) 
                        <form action="processes/unlike.php" name="unlike" method="post">
                            <input type="hidden" name="like_id" value="{{App\House_like::getLike($house->id, Auth::user()->id)->id}}" />
                            <button type="submit" name="submit" class="btn-danger" value="Unlike"><span class="fa fa-thumbs-down"></span> Unlike</button>
                            <!--<input type="submit" name="submit" class="btn-danger" value="Unlike" /> -->
                        </form>
                    @else
                        <form action="processes/like.php" method="post">
                            <input type="hidden" name="realtor_id" value="{{Auth::user()->id}}" />
                            <input type="hidden" name="type_id" value="{{$house->id}}" />
                            <input type="hidden" name="type" value="house" />
                            <button type="submit" name="submit"  class="btn-info" value="Like"><span class="fa fa-thumbs-up"></span> Like</button>
                            <!--<input type="submit" name="submit" class="btn-success" value="Like" />-->
                        </form>
                    @endif 
                @endif
                @include('inc.public.share')
            
            </div>

			<div class="vhouse_details__img_cont">
				<div id="full-images">
					@if($house->house_photos->count()==0)
						<img src="images/no_image.png" />
					@else
						@foreach($house->house_photos as $housePhoto) 
							<img id="{{$housePhoto->id}}" class="house-img" src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/{{$housePhoto->photo}}" @if($housePhoto->main == 1) style="z-index:1;" @endif /><br/>
						@endforeach
					@endif
				</div>
				
				<div class="vhouse_details__thumb">
					<ul id="thumbnails" class="" data-id="{{$house->id}}">
						@foreach($house->house_photos as $housePhoto)
							<li>
								<div class="thumb">
									<!--<a data-lightbox="example-1" data-lightbox="example-1" href="images/houses/<?php //echo $house->house_id.'/'.$photo; ?>" data-title="">-->
									<img class="house-timthumb" data-id="{{$housePhoto->id}}" src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{$housePhoto->photo}}"  />
									<!--</a>-->
								</div>
							</li>
						@endforeach
						<script src="js/lightbox.js"></script>
					</ul> 
				</div>    
			</div>

			<div id="house-info" class="vhouse_details__info">

				<h4 class="vhouse_details__info__heading">House Information <i class="fa fa-caret-up"></i></h4>
				<div id="view_fold">
					<div class="col-12 vhouse_details__info__location">
                        <div>
                          <span class="fa fa-map-marker-alt"></span> Location <i class="fa fa-angle-double-right"></i> {{$house->location->name}}  
                        </div>
						
						<div> 
                            ₦ {{number_format($house->price)}} 
                            @if($house->status=='rent')
                                (Per Annum)
                            @endif
                        </div>
					</div>
					<div class="col-12 vhouse_details__info__description">
                        
						<div class="row">
							<div class="col-6 col-lg-12 vhouse_details__info__description__1">
								<div class="row">
									<div class="col-lg-4"><span class="fa fa-bed"></span> Bedrooms {{$house->bedrooms}}</div>
									<div class="col-lg-3"><span class="fa fa-shower"></span> Bathrooms {{$house->bathrooms}}</div>
									<div class="col-lg-5"><span class="fa fa-home"></span> House Type <i class="fa fa-angle-double-right"></i> 
									{{$house->house_type->type}}</div>
								</div>
							</div>

							<div class="col-lg-12 col-6 vhouse_details__info__description__1 ">
								<div class="row">
									<div class="col-lg-4 no-padding"><span class="fa fa-list"></span> Total Rooms {{$house->rooms}}</div>
									<div class="col-lg-3 no-padding"><span class="fa fa-bath"></span> Toilets {{$house->toilets}}</div>
									<div class="col-lg-5 no-padding"><span class="fa fa-tint"></span> Water Source 
										<i class="fa fa-angle-double-right"></i> {{$house->water_source}}</div> 
								</div>
							</div>
							@if($house->facilities != '')
								<div class="vhouse_details__info__description__facilities">
									<h4>Facilities </h4>
									<div>{{$house->facilities}}</div>
								</div>
							@endif
							@if($house->description != '')
							<div class="vhouse_details__info__description__facilities">
								<h4>Description</h4>
								<div>{!! $house->description !!}</div>
							</div>
							@endif
							
							@if(!empty($house->sale_plan))
								<div class="vhouse_details__info__description__facilities">
									<h4>Sale Plan</h4>
									<div>{{$house->sale_plan}}</div>
								</div>
							@endif
						</div>
                        
                    </div>
					
					<div class="col-12 vhouse_details__info__fee">
						<ul class="m-0 p-0">
							<li class="col-6">Agent Fee : {{empty($house->agent_fee)? '₦ 0' : '₦ '.number_format($house->agent_fee)}}</li>
							<li class="col-6">Service Charge : ₦ {{number_format($house->service_charge)}}</li>
						</ul>
						
					</div>
				</div>
			</div>

			<div class="col-12 vhouse_details__comm">

				@if(!Auth::user())
					<h6>
						<a href="realtors/login.php">Login</a> Or 
						<a href="realtors/register.php">Register</a> to comment on this house
					</h6>
				@endif

				<section class="sect">
					<h5 id="comment-count"><span class="fa fa-comments"></span> Comments {{$house->house_comments->count()}}</h5>
					<div id="comments">
						@foreach($house->house_comments as $comment) { 
							<div class="comment col-sm-12 col-md-12">
								<i class="pull-right">{{date('jS M Y', $comment->created_at)}}</i>
								<h4><span class="fa fa-user"></span> {{$comment->realtor->fullname}} </h4>
								<p>
									{{$comment->comment}}
								</p>
								<hr/>
								@if(Auth::user()) 
									@if((Auth::user()->id==$house->id) || (Auth::user()->id==$comment->realtor_id)) 
										<a class="btn-danger" href="{{url('delete_comment/'.$comment->id)}}" 
										onClick=" return confirm('Are You Sure You Want to delete this comment?')"><span class="fa fa-trash"></span> Delete
										</a>
									@endif
								@endif
							</div>
						@endforeach
					</div>
					               
				</section>

				<div class="clear"></div>
					@if((Auth::user()) && (Auth::user()->type!='company') && (Auth::user()->id != $house->realtor_id) && (Auth::user()->connected_house($house->id)))
						<section class="sect1">
								<h3>LEAVE A COMMENT</h3>
							
							<p id="comment-msg"></p>
							
							<div class="form-group">
								<textarea class="form-control" name="comment" rows="8"> </textarea>
							</div>
							<div class="form-group">
							<img id="imgcaptcha" src="processes/captchaimg.php" /><br/>
							Enter the Value of the captcha image above<br/>
							<input class="form-control" type="text" name="captcha" required  />
							</div>
							
							<input type="hidden" class="form-control" id="captcha_check" />
							<input type="hidden" name="count" value="{{$house->house_comments->count()}}" />
							<input type="hidden" name="house_id" value="{{$house->id}}" />
							<input type="hidden" name="realtor_id" value="{{Auth::user()->id}}" />
							<input type="hidden" name="realtor_name" value="{{Auth::user()->fullname}}" />
							<div class="form-group">
							<input type="submit" class="form-control btn-info" name="submit-comment" value="Comment" />
							</div> 
						</section>
					@endif

			</div>


		</div>
	</div>