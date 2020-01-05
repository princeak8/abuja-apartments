<div style="overflow-y:scroll; max-height: 100vh;" >
    <div class="content__left__profile">
        <a href="{{url('realtor/profile')}}">
        <div class="content__left__profile__img">
            @if(!empty(Auth::user()->profile_photo))
                <img src="{{env('APP_STORAGE')}}images/profile_photos/{{Auth::user()->profile_photo}}" class="img-responsive" />
            @else
                <img src="{{env('APP_STORAGE')}}images/profile_photos/no_img.png" class=" img-responsive" />
            @endif
        </div>
        </a>
        <div class="content__left__profile__details">
            <p class="my-1">
                <a href="{{url('realtor/profile')}}">{{Auth::user()->biz_name === null ? Auth::user()->firstname : Auth::user()->biz_name}} 
                {{Auth::user()->biz_name === null ? Auth::user()->lastname : ''}}</a>
            </p>
            <p class="my-1">
                <a href="{{url('realtor/profile')}}">{{Auth::user()->email}}</a>
            </p>
            <p class="my-2">
                <a href="{{url(Auth::user()->profile_name)}}" class="btn btn-success btn-sm">Business Page</a>
            </p>
            @if(Auth::user()->type=='company')
                <p class="hse_est">
                    <a href="{{url('realtor/houses')}}" class="">Houses</a>
                    <a href="{{url('realtor/estates')}}" class="">Estates</a>
                </p>
            @endif
        </div>
    </div>  
    <div class="content__left__list" role="navigation">
        <ul class="" id="settings">
            <li><a href="{{url('realtor/home')}}"> <i class="fa fa-home"></i> Home</a></li>
            <li>
                <a href="{{url('realtor/messages')}}"> <i class="fa fa-envelope"></i> Messages <span class="label label-success">{{count(Auth::user()->unread_messages)}}</span></a>
            </li>
            <li>
                <a href="{{url('realtor/mycircle')}}"><i class="fa fa-bullseye"></i> My Circles</a>
            </li>
            <li>
                <a href="{{url('realtor/requests')}}"> <i class="fa fa-question-circle"></i> Requests <span class="label label-default">{{$requests}}</span></a>
            </li>
            <!--
            <li>
                <a href="index.php?page=followers"> <span class="fa fa-user-circle-o"></span> Followers <span class="label label-info"><?php //echo count($followers); ?></span></a>
            </li>
            -->
            <li>
                <a href="{{url('realtor/tickets')}}"> <i class="fa fa-ticket-alt"></i> Support Tickets</a>
            </li>
            <li class="pull-right">
                <a href="{{url('realtor/logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
</div>
