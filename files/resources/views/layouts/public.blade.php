{{-- @include('inc.public.head_links') --}}

@include('inc.public.frontpage.head_links')

{{-- @include('inc.public.header') --}}

@include('inc.public.frontpage.header')


{{-- @include('inc.public.navbar') --}}
<div class="container-fluid mt-4"> 
    <div class="row">      
        @yield('content')
    </div>
</div>


{{-- @include('inc.public.footer') --}}

</body>

@include('inc.public.frontpage.footer')

<script type="application/javascript" src="{{asset('js/jquery.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/popper.js')}}"></script>
{{-- <script type="application/javascript" src="{{ asset('js/ionicon.js')}}"></script> --}}


<script type="application/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="application/javascript" src="{{asset('js/constants.js')}}"></script>
<script type="application/javascript" src="{{asset('js/scroll_top.js')}}"></script>
<script type="application/javascript" src="{{asset('js/toggle_filters.js')}}"></script>
<script type="application/javascript" src="{{asset('js/vue.js')}}"></script>
<script type="application/javascript" src="{{asset('js/axios.min.js')}}"></script>

@yield('js')

</html>
