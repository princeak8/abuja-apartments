<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--<meta http-equiv="refresh" content="60">-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width" />
<meta name="msvalidate.01" content="F40836B3AF0D6B7161FFA103ED54CA38" />
<meta name="yandex-verification" content="7873f4221c789b35" />
<meta name="keywords" content="Abuja, Real Estate Platform, Houses, rent, sale, houses for rent, houses for sale, affordable price, apartments" />
<meta property="og:description" content="Abuja Apartments is an online Real Estate platform that aims to make it easy for anybody within Abuja environs to easily have access to houses either for rent or for sale. " />
<title>Abuja Apartments</title>

<link rel="icon" href="{{ asset('images/symbol.png') }}" />

<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" media="all" href="{{asset('css/font-awesome-all.min.css')}}"/>



{{-- <link rel="stylesheet" type="text/css" href="{{asset('css/styles_agent.css')}}"/> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/realtor/realtor.css')}}"/>
<style type="text/css">
    [v-cloak] .v-cloak--hidden {
        display: none !important;
        margin-top: 20px;
    }
</style>
</head>

<body>
@include('inc.realtor.header')
<div class="content">
    <div class="content__left menuContainer hideMenu">
        @include('inc.realtor.top_menu')
    </div>

    <div class="row content__right">

        @include('inc.realtor.profile_left_menu', ['page'=>$page])
		<div class="col-md-8 right-content_p" style="border: solid thin #000">

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


