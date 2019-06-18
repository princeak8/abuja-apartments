@if($realtor->type=='company') 
    <h6 class="text-center py-2">Estates</h6>
    <div class="row r_estate mb-4">
        
        @foreach($realtor->estates as $estate) 
            <div class="col-lg-4 col-6 r_estate__container px-2">
                <a href="{{url('estate/'.$estate->id)}}">
                    <div class="cover">
                        <div class="r_estate__container__img">
                            {{-- <a href="{{url('estate/'.$estate->id)}}"> --}}
                                @if(App\House_photo::GetMainPhoto($estate->id)->count())
                                    <img class="img-responsive" src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{App\Estate_photo::GetMainPhoto($estate->id)->first()->photo}}" /><br/>
                                @elseif(App\Estate_photo::GetEstatePhotos($estate->id)->count())
                                    <img class="img-responsive" src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{App\Estate_photo::GetEstatePhotos($estate->id)->first()->photo}}" />
                                @else
                                    <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
                                @endif
                            {{-- </a> --}}
                        </div>
                    
                        <div class="r_estate__container__description">
                            <p><i class="fa fa-tag"></i> {!! check_string_length($estate->name) !!}
                            <br/>
                            <i class="fa fa-map-marker-alt"></i> {{$estate->location->name}}
                            </p>
                            {{-- <p class="no-padding">
                                <a href="{{url('estate/'.$estate->id)}}"><span class="fa fa-eye"></span> View</a>
                            </p> --}}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif