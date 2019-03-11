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
@include('inc.public.frontpage.footer')
