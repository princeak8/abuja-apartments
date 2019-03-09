@include('inc.public.head_links')

@include('inc.public.header')

@include('inc.public.navbar')
        
    @yield('content')

    @yield('js')
    
@include('inc.public.footer')