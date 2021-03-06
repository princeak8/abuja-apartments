<div class="vhouse__left__pic__imgcont"> 
    <div id="full-images" class="">
        @foreach($house->house_photos as $photo)
            <div class="">  
                <img class="house-img" 
                id="{{$photo->id}}" 
                src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/{{$photo->photo}}" @if($photo->main == 1) style="z-index:1;" @endif />
            </div>
        @endforeach
    </div>
</div>
@if(request()->session()->exists('photo_msg'))
    <p class="alert alert-success">{{session('photo_msg')}} </p>
@endif


<div id="thumbnails" class="row vhouse__left__pic__thumb" data-id="{{$house->id}}" >
    @foreach($house->house_photos as $photo) 
        <div class="col-lg-4" id="photo-group-{{$photo->id}}">
            <div class="vhouse__left__pic__thumb__container">
                <div id="photo-{{$photo->id}}" class="thumb_container">
                    <img id="data{{$photo->id}}" data-id="{{$photo->id}}" class="house-timthumb"
                    src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{$photo->photo}}" />
                    {{-- <span id="info{{$photo->id}}" class="col-sm-6 col-xs-7 border border-danger" style="color: #BBB;"></span> --}}
                </div>
                <div id="photo-title-{{$photo->id}}" class="house_title" >
                    @if(!$house->is_shared(Auth::user()->id))
                        <input type="radio" name="main" data-id="{{$photo->id}}" @if($photo->main==1) checked @endif />
                    @endif
                    {{  empty($photo->title) ? ' Untitled' : $photo->title   }}
                </div>
                
                @if(!$house->is_shared(Auth::user()->id))
                <div id="control-group-{{$photo->id}}" class="house_action">
                    {{-- <input type="radio" name="main" data-id="{{$photo->id}}" @if($photo->main==1) checked @endif /> --}}
                    <!--<a href="{{url('realtor/edit_photo/'.$photo->id)}}">-->
                        <button class="btn btn-outline-primary btn-sm edit-control" data-id="{{$photo->id}}" data-open="0">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                    <!--</a>-->
                    <button class="btn btn-outline-danger btn-sm delete-btn" data-id="{{$photo->id}}"> 
                        <i class="fa fa-trash"></i> Delete
                    </button><br class="hidden-xs">
                </div>

                <div id="edit-form-{{$photo->id}}" class="edit_house_form" style="margin-top: 5px; display: none;" >
                    <span id="close_{{$photo->id}}" data-id={{$photo->id}}></span>
                    @include('inc.realtor.view_house.edit_image_form')
                </div>
                @endif
            </div>
        </div>
    @endforeach
    
</div>
