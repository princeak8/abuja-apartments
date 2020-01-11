<!doctype html>
<html>
@include('inc.public.frontpage.head_links')

<body>

@include('inc.public.frontpage.header')

<input type="hidden" name="APP_URL" value="{{env('APP_URL')}}" />
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<input type="hidden" name="APP_STORAGE" value="{{ env('APP_STORAGE') }}" />

{{-- @include('inc.public.navbar') --}}
<div class="container-fluid contentWrapper" style="position: relative; overflow: hidden;">
    <div class="search_realtor hideSearch" id="searchRealtor">
        <form action="processes/search_realtor.php" method="post" class="">
            <input type="hidden" name="active" value="0" />
            <div class="search_realtor__container">
                <div class="search_realtor__container__input">
                    <input class="form-control mr-sm-2" type="search" name="search_realtor" required placeholder="Search Realtor" aria-label="Search">
                </div>
                <div class="search_realtor__container__button">
                    <button class="btn btn-primary" type="submit" name="submit"><span class="fa fa-search"></span></button>
                </div>
            </div>
        </form>
    </div>
    <div class="row pt-4">
        @yield('content')
    </div>
    
</div>
        
@include('inc.public.frontpage.footer')
<script type="application/javascript" src="{{asset('js/jquery.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/popper.js')}}"></script>
{{-- <script type="application/javascript" src="{{ asset('js/ionicon.js')}}"></script> --}}

<script type="application/javascript" src="{{ asset('js/lightgallery-all.js') }}"></script>


<script type="application/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="application/javascript" src="{{asset('js/constants.js')}}"></script>
<script type="application/javascript" src="{{asset('js/scroll_top.js')}}"></script>
<script type="application/javascript" src="{{asset('js/toggle_filters.js')}}"></script>
<script type="application/javascript" src="{{asset('js/vue.js')}}"></script>
<script type="application/javascript" src="{{asset('js/axios.min.js')}}"></script>
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
<script type="application/javascript">
    $(document).ready(function(){ 
        $('#clickOnPhoto img').click(function(){
            $('#profileOverlay').css({
                display: 'flex'
            })
            setTimeout(() => {
              $('.overlay__container').css({
                    transition: 'all 1s ease-in-out',
                    transform : 'translateX(2%)',
                    // marginRight: '0%'
                })  
            }, 50);
            
        })
        $('#profileOverlayClose').click(function() {
            $('.overlay__container').css({
                transition: 'all 1s ease-in-out',
                transform : 'translateX(100%)',
            })
            setTimeout(() => {
                $('#profileOverlay').css({
                    display: 'none'
                })
            }, 1000);
            
        })

        $('#displaySearch').click(function() {
            if($('#searchRealtor').hasClass('hideSearch')) {
                $('#searchRealtor').removeClass('hideSearch')
                $('#searchRealtor').addClass('showSearch')
            } else {
                $('#searchRealtor').removeClass('showSearch')
                $('#searchRealtor').addClass('hideSearch')
            }
        })
        $('#phoneDisplaySearch').click(function() {
            if($('#searchRealtor').hasClass('hideSearch')) {
                $('#searchRealtor').removeClass('hideSearch')
                $('#searchRealtor').addClass('showSearch')
            } else {
                $('#searchRealtor').removeClass('showSearch')
                $('#searchRealtor').addClass('hideSearch')
            }
        })
        $('#toggleFilter').click(function() {
            if($(this).hasClass('collapseFilter')) {
                $(this).removeClass('collapseFilter')
                $(this).addClass('collapseFilterActive')
            } else {
                $(this).removeClass('collapseFilterActive')
                $(this).addClass('collapseFilter')
            }
            if($('.filter_container').hasClass('hideFilter')) {
                $('.filter_container').removeClass('hideFilter')
                $('.filter_container').addClass('showFilter')
            } else {
                $('.filter_container').removeClass('showFilter')
                $('.filter_container').addClass('hideFilter')
            }
        })
        // alert('got here')
        $('#collapseBtn').click(function(){
            if($(this).hasClass('collapseBtn')) {
                $(this).removeClass('collapseBtn')
                $(this).addClass('collapseBtnActive')
            } else {
                $(this).removeClass('collapseBtnActive')
                $(this).addClass('collapseBtn')
            }
        })
        
        
        
    })
</script>
@yield('js')

</html>