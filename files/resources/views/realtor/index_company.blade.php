{{-- @include('inc.realtor.company_head_links') --}}

@extends('layouts.realtor')

@section('content')

<div id="main-content" class="content__right__main">
	{{-- <div id="left-side" class="col-md-2 col-sm-2">
		<ul class="no-padding">	
            <li><a href="{{url('realtor/estates')}}"><span class="fa fa-building"></span> Estates <span class="fa fa-angle-double-right"></span></a> </li>
            <li><a href="{{url('realtor/houses')}}"><span class="fa fa-building-o"></span> Houses <span class="fa fa-angle-double-right"></span></a> </li>
        </ul>
        <div class="hidden-xs col-sm-12 left_prof_cont">
            @if(!empty($realtor->profile_photo))
              <img src="{{env('APP_STORAGE')}}images/profile_photos/{{$realtor->profile_photo}}" class="img-responsive" />
            @else
              <img src="{{env('APP_STORAGE')}}images/profile_photos/no_img.png" class=" img-responsive" />
            @endif
            <div class="left_prof">
                <a href="{{url('realtor/profile')}}" ><span class="fa fa-address-card-o"></span> My Profile</a>
            </div>
        </div>
	</div> --}}

    @include('inc.realtor.estate.estate_link')

    <div class="content__right__main__estates">
            
                <div class="content__right__main__estates__hse">
                    <a href="{{url('realtor/houses')}}">Houses</a>
                </div>
            
                <div class="content__right__main__estates__es">
                    <a href="{{url('realtor/estates')}}" >Estates</a>
                </div>
            

        {{-- @include('inc.realtor.houses') --}}

    </div>

</div>

@endsection