@extends('layouts.frontpage')


@section('content') 
    @include('inc.public.frontpage.houses_components.filtering')
{{-- <div class="h_e">
    <div class="col-sm-2 h_e1">
        <p>
	        <a href="index.php?houses"><span class="fa fa-building"></span> Houses </a> | 
	        <a href="index.php?estates"><span class="fa fa-building-o"></span> Estates <span class="fa fa-angle-double-right"></span></a>   
	    </p>
    </div>
    <div class="col-sm-6 show_case">
        <p>Are you an Estate Management Firm or a house Agent? show case your houses for free !!  </p>
    </div> 
	@if(Auth::user())
        <div class="col-sm-4 reg_now">
            <p>
            	<a href="realtors/company_register.php">Register as Company Now!</a> or <a href="realtors/register.php">Register as Individual Now!</a>
            </p>
        </div>
    @endif	
    <div class="clear"></div>
</div> --}}



    <!-- The Left-side with the FILTERS -->
    <div class="col-md-2 col-lg-2 filter_container hideFilter">     
        @include('inc.public.filters')
    </div>
    @include('inc.public.frontpage.houses')

@endsection

@section('js')

<script>
	$(document).ready(function(){ 
		// $('.mouseoverHouse').each(function(){
		// 	var cover = $(this);
		// 	$(this).find('a').not('a.delete').mouseover(function() {
		// 		cover.find('.cover').css({
		// 			'height': '98%'
		// 		});
		// 		cover.find('.mouseoverDetails a').css({
		// 			'color': 'white'
		// 		})
		// 	})
		// 	$(this).mouseleave(function() {
		// 		$(this).find('.cover').css('height', '0')
		// 		$(this).find('.mouseoverDetails a').css({
		// 			'color': '#636b6f'
		// 		})
		// 		$(this).find('.mouseoverDetails a.delete').css({
		// 			'color': 'rgb(235, 65, 65)'
		// 		})
		// 	})
		// })
		
	})
</script>

@endsection
