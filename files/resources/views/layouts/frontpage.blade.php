@include('inc.public.frontpage.head_links')

@include('inc.public.frontpage.header')

@include('inc.public.navbar')
        
    @yield('content')

    @yield('js')

@include('inc.public.frontpage.footer')