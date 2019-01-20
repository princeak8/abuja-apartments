<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1758712591124868";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="header" class="container-fluid no-padding">
        
    <div class="col-xs-12 col-sm-8 col-md-6 logo">
	   <!--<img class="img-responsive" src="../../images/logo2.png" />-->
     <img class="img-responsive" src="{{env('APP_STORAGE')}}images/Abj_logo_realtor.png" />
    </div>
    
    <div class="col-md-3 col-sm-4 search">
        <form action="../../processes/search_realtor.php" method="post">
            <input type="hidden" name="active" value="1" />
            <div class="col-md-9 col-xs-8 no-padding">
                <input class="form-control input-sm" type="text" name="search_realtor" placeholder="search realtor" />
            </div>
            <div class="col-md-3 col-xs-2 no-padding">
                <button class="form-control btn-info input-sm" type="submit" name="submit" value="Search"><span class="fa fa-search"></span></button>
                <!--<input class="form-control" type="submit" name="submit" value="Search" /> -->
            </div>
        </form>
    </div>

    <div class="col-md-3 col-xs-12 wel_cont">
      <div class="col-xs-8 col-sm-12 no-padding p_1st shadow">
		   <p class="wel col-sm-12 cap_1st no-margin">
			  <a href="{{url('realtor/profile')}}" >
					<i class="glyphicon glyphicon-user"></i> {{Auth::user()->full_name}}
			  </a>
		   </p>
		   <p class="col-sm-12 no-margin wel2">
			 <a href="{{url('realtor/profile')}}" ><span class="fa fa-address-card-o"></span> My Profile</a>
		   </p>
       
       </div>
       <div class="visible-xs col-xs-4 no-margin xs_hd_img">
            @if(!empty(Auth::user()->profile_photo))
              <img src="{{env('APP_STORAGE')}}images/profile_photos/{{Auth::user()->profile_photo}}" class="img-responsive" />
            @else
              <img src="{{env('APP_STORAGE')}}images/profile_photos/no_img.png" class=" img-responsive" />
            @endif

       </div>
       <p class="col-sm-12 col-xs-12 no-margin biz_head">
         <a href="{{url(Auth::user()->profile_name)}}"><span class="fa fa-angle-double-right"></span> Business Page</a> &nbsp;<i class="fa fa-ellipsis-v"></i>&nbsp; 
         <!--<a href="../../<?php //echo $realtor->profile_name ?>">My Admin Page <span> </span> </a> -->
      </p>  
    </div>
        
</div>