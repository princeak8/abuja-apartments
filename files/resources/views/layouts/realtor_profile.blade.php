@include('inc.realtor.header')
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles_frontpage.css')}}"/>

    <input type="hidden" name="APP_URL" value="{{env('APP_URL')}}" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="APP_STORAGE" value="{{ env('APP_STORAGE') }}" />
    
@include('inc.realtor.top_menu')

    <div id="search-results" class="col-md-12" style="background-color: #FFF;">
    </div>


<div id="content" class="col-xs-12 col-md-12 no-padding">
    <div class="cont_of_profile col-sm-11">

	    @include('inc.realtor.profile_left_menu', ['page'=>$page])
	        
		<div class="col-sm-9 right-content_p" >

            @yield('content')

        </div><!--End of right-content_p -->
	
    <div class="clear"></div>

    </div><!-- end of cont_of_profile -->
	        
</div>

<script type="application/javascript" src="{{asset('js/app.js')}}"></script>
<script type="application/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="application/javascript" src="{{asset('js/constants.js')}}"></script>
<script type="application/javascript" src="{{asset('js/vue.js')}}"></script>
<script type="application/javascript" src="{{asset('js/axios.min.js')}}"></script>

<script type="application/javascript">
$(document).ready(function(e) {
	 //alert('working');
	$('.houses').css('display', 'none');
	$('#available').css('display', 'block');
    $('.nav-tabs li').click(function(e) {
       var id = $(this).data('id');
	   $('.houses').css('display', 'none');
	   $('#'+id).css('display', 'block');
	   $('li').each(function(index, element) {
        $(this).removeClass('active');
		$('#'+id).addClass('active');
    });
	   
    });
});
</script>

@include('inc.realtor.footer')

@yield('js')

<script type="application/javascript" src="{{asset('js/scroll_top.js')}}"></script> 


