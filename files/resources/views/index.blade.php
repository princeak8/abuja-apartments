@extends('layouts.frontpage')


@section('content') 

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
    <div class="col-md-2 col-lg-2">     
        @include('inc.public.filters')
    </div>
    @include('inc.public.frontpage.houses')

@endsection
