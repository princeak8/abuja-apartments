<!doctype html>
<html>
@include('inc.public.frontpage.head_links')

<body>

@include('inc.public.frontpage.header')

{{-- @include('inc.public.navbar') --}}
<div class="container-fluid mt-4">
    <div class="row">
        @yield('content')
    </div>
    
</div>
        
@include('inc.public.frontpage.footer')
<script type="application/javascript" src="{{asset('js/jquery.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/popper.js')}}"></script>
<script type="application/javascript" src="{{ asset('js/ionicon.js')}}"></script>


<script type="application/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="application/javascript" src="{{asset('js/scroll_top.js')}}"></script>
<script type="application/javascript" src="{{asset('js/toggle_filters.js')}}"></script>
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
{{-- @yield('js') --}}
</body>

@yield('js')

</html>