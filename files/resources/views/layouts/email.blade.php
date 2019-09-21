{{-- @include('inc.public.head_links') --}}

@include('inc.public.frontpage.head_links')


{{-- @include('inc.public.navbar') --}}
<div class="container-fluid mt-4"> 
    <div class="row"> 
        <div class="col-md-8 offset-md-2" style="border: solid thin #CCC; min-height: 600px;">
            <div class="col-md-4 offset-md-4 mb-3">
                <img class="img-responsive" src="{{ asset('images/logo.png') }}" />
            </div> 
            <hr/>
            @yield('content')

            <div class="col-md-6 offset-md-3 mt-6" style="position: absolute; bottom:10px;">
                <p class="text-center">
                    <a href="https://www.zizix6.com">Visit our Website</a>
                </p>
                Copyright Â© Zizix6 Nigeria limited, All rights reserved.
            </div>
        </div>

    </div>

</div>


</html>
