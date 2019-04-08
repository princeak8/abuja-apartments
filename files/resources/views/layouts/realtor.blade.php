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

<link rel="icon" href="{{env('APP_STORAGE')}}images/abuja_apa_log.png" />

<link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" media="all" href="{{asset('css/font-awesome-all.min.css')}}"/>

<script type="application/javascript" async src="{{ asset('js/jquery-3.3.1.js')}}"></script>
<script type="application/javascript" async src="{{ asset('js/popper.js')}}"></script>
<script type="application/javascript" async src="{{ asset('js/bootstrap.min.js')}}"></script>

<script type="application/javascript" src="{{asset('js/tinymce/tinymce.min.js')}}"></script>

<script type='text/javascript'>
tinymce.init({
    selector:  '.tinymce',
	content_css : "css/bootstrap.min.css",
	relative_urls: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor hr pagebreak', 
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu jbimages',
		'emoticons template paste textcolor'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | forecolor backcolor emoticons | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages |print preview media',    
});
</script>

{{-- <link rel="stylesheet" type="text/css" href="{{asset('css/styles_agent.css')}}"/> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/realtor/realtor.css')}}"/>

</head>

<body>
    @include('inc.realtor.header')

    <div class="content">
        <div class="content__left">
            @include('inc.realtor.top_menu')
        </div>
        <div class="content__right">
            <div id="search-results" class="col-md-12" style="background-color: #FFF;"></div>
            @yield('content')
        </div>
    </div>

    <script type="application/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="application/javascript" src="{{asset('js/jquery.min.js')}}"></script>

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

    @yield('js')

    {{-- @include('inc.realtor.footer') --}}
</body>

</html>