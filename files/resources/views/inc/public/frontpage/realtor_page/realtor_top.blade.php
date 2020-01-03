<div class="realtor_top">

    <div class="row px-3 pl-4">
        <div class="col-lg-1 col-1 realtor_top__img p-0 border">
            @if(!empty($realtor->profile_photo)) 
                <a data-lightbox="example-1" data-lightbox="example-1" href="images/profile_photos/{{$realtor->profile_photo}}">
                    {{-- <img src="images/profile_photos/{{$realtor->profile_photo}}" class="img-rounded img-responsive" /> --}}
                    <img src="{{ asset('images/profile_pic2.png') }}" class="img-rounded img-responsive" />
                </a>
            @else
                <a data-lightbox="example-1" data-lightbox="example-1" href="">
                    <img src="{{ asset('images/profile_pic2.png') }}" class="img-rounded img-responsive" />
                </a>	
            @endif
            <script src="{{asset('js/lightbox.js')}}"></script>
        </div>

        <div class="col-lg-11 col-11 realtor_top__details">
            @php $type = $realtor->type @endphp
            
            <h4 class="realtor_top__details__title">
                {{$realtor->name}} Page
                
            </h4>
            <div class="row">
                <div class="realtor_top__details__subtitle col-6">
                    @include('inc.public.share')
                </div>
            
            
                <!-- The follow starts here -->
                <div class="realtor_top__details__follow col-6">
                    <div class="">
                        @if(Auth::user())
                            @if(Auth::user()->type != 'company' && Auth::user()->id != $realtor->id)
                                <!-- If user is NOT following this realtor -->
                                @if(!$realtor->is_follower(Auth::user()->id))
                                    <form action="processes/follow.php" method="post" style="display:inline-block;">
                                        <input type="hidden" name="followed" value="{{$realtor->id}}" />
                                        <input type="hidden" name="follower" value="{{Auth::user()->id}}" />
                                        <button  class="btn btn-outline-info py-0" type="submit" name="submit" value="Follow This Realtor" >
                                            <span class="fa fa-user-plus"></span> Follow Realtor
                                        </button>
                                    </form>
                                @endif
                                <!-- If user is following this realtor -->
                                @if($realtor->is_follower(Auth::user()->id))
                                    <form action="processes/unfollow.php" name="unfollow" method="post" style="display:inline-block">
                                        <input type="hidden" name="follow_id" value="{{App\Follower::getFollow($realtor->id, Auth::user()->id)->id}}" />
                                        <button class="btn btn-outline-danger py-0" id="unfollow" type="submit" name="submit" value="Unfollow" >
                                            <span class="fa fa-user"></span><span class="fa fa-minus"></span> Unfollow</button>
                                        <!--<input class="btn-danger" id="unfollow" type="submit" name="submit" value="Unfollow" />-->
                                    </form>
                                @endif
                            @endif
                            
                            @if(Auth::user()->id != $realtor->id && Auth::user()->activated==1 && Auth::user()->rship_exists($realtor->id))
                                @if(Auth::user()->request_sent($realtor->id))
                                    <b class="green">Circle Request Sent | </b>
                                @endif
                            @else
                                <form action="processes/send_circle_request.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="accepter" value="{{$realtor->id}}" />
                                    <input type="hidden" name="requester" value="{{Auth::user()->id}}" />
                                    <button type="submit" name="submit" value="Add to Circle" class="btn btn-default py-0">
                                        <span class="fa fa-rss"></span> Add to Circle
                                    </button>
                                    <!--<input type="submit" name="submit" value="Add to Circle" />-->
                                </form>
                            @endif 
                        @endif
                        <span class="text-info">
                            Followers <span class="badge badge-info">{{$realtor->followers->count()}}</span>
                        </span>
                    </div>
                </div><!-- The follow ends here -->
            </div>

        </div>

    </div>
    
</div>