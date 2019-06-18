
<a href="house/{{$house->id}}">
    <div class="house__upper__img_price__img ">
        @if(App\House_photo::GetMainPhoto($house->id)->count())
            <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetMainPhoto($house->id)->first()->photo}}" />
        @elseif(App\House_photo::GetHousePhotos($house->id)->count())
            <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetHousePhotos($house->id)->first()->photo}}" />
        @else
            <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
        @endif
    </div>
</a>
