{{-- @include('inc.realtor.company_head_links') --}}

@extends('layouts.realtor')

@section('content')

<div id="main-content" class="content__right__main">
    <div>
        @include('inc.realtor.estate.estate_link')

        <div class="content__right__main__estate " >
                <p>@include('inc.errors')</p>
            
                @if(request()->session()->exists('add_estate_msg'))
                    <p class="@if(session('success')==1)alert alert-success @else alert-danger @endif">
                        {{session('add_estate_msg')}} 
                    </p>
                @endif
                <div class="content__right__main__estate__title">
                    @if(isset($_SERVER['HTTP_REFERER'])) 
                        <h4 class="">
                            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fa fa-caret-left"></i> Back</a>
                        </h4> 
                    @endif

                    <h3 class="">{{$estate->name}}</h3>
                </div>
                <div class="row container-fluid">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="content__right__main__estate__imgfull">
                                    <div id="full-images">
                                        @if(App\Estate_photo::GetMainPhoto($estate->id)->count()) 
                                            @php $mainPhotoId = 0; @endphp
                                        @else
                                            @php $mainPhotoId = App\Estate_photo::GetEstatePhotos($estate->id)->first()->id; @endphp
                                        @endif
                                        @foreach($estate->estate_photos as $photo) 	
                                            ajsks{{$photo->main}}
                                            @if($photo->main == 1 || $photo->id==$mainPhotoId)
                                                <img 
                                                    id="{{$photo->id}}" 
                                                    class="estate-img" 
                                                    src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/{{$photo->photo}}" 
                                                    style="z-index:2;" 
                                                />
                                            @else
                                                <img 
                                                    id="{{$photo->id}}" 
                                                    class="estate-img" 
                                                    src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/{{$photo->photo}}"
                                                />
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 content__right__main__estate__imgthumb">
                                <div class="row">
                                    <span id="estate-photo-message" class="alert" style="display: none;"></span>
                                    <ul id="thumbnails" class="row m-0" data-id="{{$estate->id}}" >
                                        @foreach($estate->estate_photos as $photo) 
                                            <li id="photo-{{$photo->id}}" class="col-6 content__right__main__estate__imgthumb__thumbnails">
                                                <div class="content__right__main__estate__imgthumb__thumbnails__img">
                                                    <img class="estate-timthumb" data-id="{{$photo->id}}" 
                                                    src="{{env('APP_STORAGE')}}images/estates/{{$estate->id}}/thumbnails/{{$photo->photo}}" />
                                                </div>
                                                <div class="content__right__main__estate__imgthumb__thumbnails__details">
                                                    <input type="radio" name="main" data-id="{{$photo->id}}" @if($photo->main == 1) checked @endif />
                                                    <button class="btn btn-info btn-sm edit-control" data-id="{{$photo->id}}" data-open="0">
                                                        Edit
                                                    </button>
                                                    <button 
                                                        class="btn btn-danger btn-sm delete-btn" 
                                                        data-id="{{$photo->id}}"
                                                        onClick="return confirm('Are You Sure that You want to delete this photo?')"
                                                    > 
                                                        <i class="fa fa-trash-o"></i> Delete
                                                    </button><br class="hidden-xs">

                                                    <div id="edit-form-{{$photo->id}}" style="margin-top: 5px; display: none;" class="edit-form" >
                                                        {!! Form::open(['action' => ['Realtor\PhotoController@update_estate_photo'], 'method'=>'POST', 'enctype'=>"multipart/form-data"]) !!}
                                                            <div class="form-group">
                                                            <input class="form-control photo form-control-sm" type="file" id="photo_{{$photo->id}}" data-id="data{{$photo->id}}" name="photo" />
                                                            <input class="form-control form-control-sm" type="text" name="photo_title" placeholder="title of photo" value="{{$photo->title}}" />
                                                            </div>
                                                            <div class="form-group"> 
                                                                <input type="hidden" name="photo_id" value="{{$photo->id}}"> 
                                                                <input type="reset" value="reset" style="display: none;">
                                                                <input class="col-12 btn btn-info btn-sm" type="submit" name="submit" value="Submit" />
                                                            </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @if(request()->session()->exists('add_estate_photo_msg'))
                            <p class="alert @if(session('success')==1) alert-success @else alert-danger @endif">
                                {{session('add_estate_photo_msg')}} 
                            </p>
                        @endif
                        <div class="col-12 content__right__main__estate__add-photo px-0">
                            <div class="pr-4">
                                <button class="col-6 btn btn-primary" id="add-photo-btn" data-open="0">Add Photo</button> 
                            </div>
                            <div class="ad_photo" id="add-photo-form"  style="display: none;">     
                                {!! Form::open(['action' => ['Realtor\PhotoController@save_estate_photo'], 'method'=>'POST', 'enctype'=>"multipart/form-data"]) !!}
                                    <h5 class="burgundy">Maximum Photo Size allowed is 10MB</h5>

                                    <div id="photo-inputs" class="">  
                                        <div class="col-sm-8 col-xs-12 no-padding">
                                        <img id="data1" class="col-sm-3 col-xs-5 no_pad_left" />
                                        <span id="info1" class="no_pad_left col-sm-6 col-xs-7" ></span>
                                        </div>
                                        <div class="clear"></div>
                                        
                                        <div class="form-group">
                                        <input class="form-control photo" type="file" id="photo_1" data-id="data1" name="photo[]" required />
                                        <input class="form-control" type="text" name="photo_title[]" placeholder="Photo Name/Title" />
                                        </div> 
                                    </div>
                                
                                    <div class="clear"></div>

                                    <div id="add-more" class="form-group" style="margin-bottom: 5px;">
                                        <button type="button" class="btn btn-primary">Add More Photos</button>
                                    </div>
                                    <div class="clear"></div> 
                                
                                    <div class="form-group"> 
                                        <input type="hidden" name="estate_id" value="{{$estate->id}}"> 
                                        <input class="form-control btn btn-info" type="submit" name="submit" value="Submit" />
                                    </div>
                                {!! Form::close() !!}    
                            </div>
                        </div>
                    </div>
                    <div id="estate-info" class="col-lg-3 content__right__main__estate__info">
                        <div class="estate-info ">
                            <h4 class="content__right__main__estate__info__title"> Estate Information</h4>
                            <div class="content__right__main__estate__info__body pb-3">
                                <ul>
                                    <li><i class="fa fa-tag"></i> Name <span class="fa fa-angle-double-right"></span> {{$estate->name}}</li>
                                    <li><i class="fa fa-map-marker"></i> Location <span class="fa fa-angle-double-right"></span> {{$estate->location->name}}</li>
                                    <li><i class="fa fa-tint"></i>  Water Source <span class="fa fa-angle-double-right"></span> {{$estate->water_source}}</li>
                                    <div class="clear"></div>
                                </ul>
                                <a class="btn btn-outline-primary col-12" href="{{url('realtor/edit_estate/'.$estate->id)}}">
                                    Edit Estate Information
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        
        </div>
    </div>
    <hr />

    <div class="container-fluid">
        <h4>House Portfolio <span class="fa fa-angle-right"></span>
            {{-- <a href="{{url('realtor/add_house')}}"> 
                <small class="smll">Add House <span class="fa fa-plus-square"></span></small>
            </a> --}}
            <button class="btn btn-info btn-sm" data-target="#addHouseModal" data-toggle="modal" >Add House</button>
        </h4>
        

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" data-id="available">
                <a class="nav-link active" id="available-tab" data-toggle="tab" href="#available" role="tab" aria-controls="available" aria-selected="true">Available Houses</a>
            </li>
            <li data-id="unavailable">
                <a class="nav-link" id="unavailable-tab" data-toggle="tab" href="#unavailable" role="tab" aria-controls="unavailable" aria-selected="false">Unavailable Houses</a>
            </li>
        </ul>

        @if(request()->session()->exists('success'))
            <p class="alert-success">{{session('success')}} </p>
        @endif

        <div id="portfolio-grid"  class="tab-content">            
            <div id="available" class="tab-pane fade show active" role="tabpanel" aria-labelledby="available-tab">
                @if($estate->houses->count()==0) 
                    <p> No Houses yet under this Estate </p>
                @else
                    <ul class="row">
                        @foreach($estate->houses as $house) 
                            <div class="col-lg-3">
                                <div class="house_container">
                                    <li class="estate">
                                        <div class="col-md-12 col-sm-12 img1 no-padding">
                                            <a href="{{url('realtor/house/'.$house->id)}}">
                                                @if(App\House_photo::GetMainPhoto($house->id)->count())
                                                    <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetMainPhoto($house->id)->first()->photo}}" />
                                                @elseif(App\House_photo::GetHousePhotos($house->id)->count())
                                                    <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetHousePhotos($house->id)->first()->photo}}" />
                                                @else
                                                    <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
                                                @endif
                                            </a>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 no-padding"> 
                                            <b> <span class="fa fa-bed"></span> 
                                                {{$house->bedrooms}} Bedroom {{$house->house_type->type}}
                                                <br/>
                                                <span class="fa fa-map-marker"></span> {{$house->location->name}}
                                                <span class="pull-right cap_1st re">For {{$house->status}}</span>
                                                <br/>
                                            </b>
                                            <div class="no-margin lvd text-center">
                                                <!--<a href="index.php?page=house likes&house_id=<?php //echo $house->house_id; ?>">--> 
                                                    <span class="fa fa-thumbs-up"></span> Likes [{{$house->likes}}]&nbsp;&nbsp;
                                                <!--</a>-->
                                                <a href="{{url('realtor/house/'.$house->id)}}"> 
                                                    <i class="fa fa-eye"></i> View
                                                </a> &nbsp;&nbsp; 
                                                <a 
                                                    href="{{url('realtor/delete_house/'.$house->id)}}" 
                                                    onClick="return confirm('Are You Sure You Want To Delete This House?')"
                                                > 
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </a>
                                            
                                            </div>
                                        </div>
                                    </li>
                                    <div class="clear"></div>
                                </div>
                            </div> 
                        @endforeach
                    </ul>
                @endif
                <div style="clear:both"></div>
                <div class="social">Share on:
                    <a class="soc_fb" href="http://www.facebook.com/sharer.php?u=http://www.abujaapartments.com.ng/{{Auth::user()->profile_name}}" target="_blank" title="Click to share">
                    <span class="fa fa-facebook"></span>
                    </a>

                    <a href="https://twitter.com/share" class="soc_tw twitter-share-button"{count} data-text="http://www.abujaapartments.com.ng/{{$realtor->profile_name}}" target="_blank" data-via="abujaapartments"><span class="fa fa-twitter"></span>
                    </a>

                    <a class="soc_wh" href="whatsapp://send?text=http://www.abujaapartments.com.ng/{{Auth::user()->profile_name}}" data-action="share/whatsapp/share"><span class="fa fa-whatsapp"></span>
                    </a>
                    <a class="soc_g" href="https://plus.google.com/share?url=http://www.abujaapartments.com.ng/{{Auth::user()->profile_name}}" target="_blank">
                        <span class="fa fa-google-plus"></span>
                    </a>
                </div>
            </div>

            <div id="unavailable" class="tab-pane fade" role="tabpanel" aria-labelledby="unavailable-tab">
                <h4 class="blue"><span class="fa fa-bookmark-o"></span> Unavailable Houses</h4>
                @if($estate->Unavailablehouses->count()==0)
                    <p> No Unavailable Houses </p>
                @else
                    <ul class="thumbnails row">
                        @foreach($estate->Unavailablehouses as $house) 
                            <div class="col-lg-3">
                                <div class="house_container">
                                    <li class="mix estate" >
                                        <div class="col-md-12 col-sm-12 img1 no-padding">
                                            <a href="{{url('realtor/house/'.$house->id)}}">
                                                @if(App\House_photo::GetMainPhoto($house->id)->count())
                                                    <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetMainPhoto($house->id)->first()->photo}}" />
                                                @elseif(App\House_photo::GetHousePhotos($house->id)->count())
                                                    <img src="{{env('APP_STORAGE')}}images/houses/{{$house->id}}/thumbnails/{{App\House_photo::GetHousePhotos($house->id)->first()->photo}}" />
                                                @else
                                                    <img src="{{env('APP_STORAGE')}}images/no_image.png" width="200" height="200" />
                                                @endif
                                            </a>
                                        </div>

                                        <div class="col-md-12 col-sm-12 no-padding"> 	
                                            <b> 
                                                <span class="fa fa-bed"></span>
                                                {{$house->bedrooms}} Bedroom {{$house->house_type->type}}
                                                <br/>
                                                <span class="fa fa-map-marker"></span> {{$house->location->name}}
                                                <span class="pull-right cap_1st re">For {{$house->status}}</span>
                                                <br/>
                                            </b>
                                            <div class="no-margin lvd">
                                                <a href="{{url('realtor/house'.$house->id)}}"> 
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                                <a 
                                                href="{{url('realtor/delete_house/'.$house->id)}}" 
                                                onClick="return confirm('Are You Sure You Want To Delete This House?')"
                                                > 
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <div class="clear"></div>
                                </div>
                            </div>   
                        @endforeach
                    </ul> 
                @endif
            </div>
        
        </div>

    </div>
    
</div>

@include('inc.realtor.estate.add_house_modal')

@endsection

@section('js')
<script type="application/javascript">
$(document).ready(function(e) {
    //alert('working');
	$('.estate-timthumb').click(function(e) {
        var photo_id = $(this).data('id');
    
		$('.estate-img').filter(function() {
		    return $(this).css('z-index') == 1;
		}).each(function() {
			$(this).css('z-index', 0);   
		});
		$('#'+photo_id).css('z-index', 1);
	});
	
	$('#thumbnails input').click(function(e) {
		var photo_id = $(this).data('id');
        var estate_id = $('#thumbnails').data('id');
        //alert(house_id);
		$.ajax({
			url:"{{url('realtor/change_estate_mainPhoto')}}", 
			data:{photo_id: photo_id, _token: CSRF_TOKEN}, 
			type: "post", 
			async: false, 
			success: function(data) { 
                alert(data);
				$('.estate-img').filter(function() {
				return $(this).css('z-index') == 1;
				}).each(function() {
					$(this).css('z-index', 0);   
				});
				$('#'+photo_id).css('z-index', 1);
			}
		}) 
    });

    $('#add-photo-btn').click(function(){ //alert('clicked');
    	var open = $(this).data('open');
    	if(open==0) {
    		$('#add-photo-form').css('display', 'block');
    		$(this).data('open', '1');
    	}
    	if(open==1) {
    		$('#add-photo-form').css('display', 'none');
    		$(this).data('open', '0');
    	}
    });

    //The script that adds new form for photo upload starts here
    var i = 1;
    $(document).on('click', '#add-more button', function() {  //alert('clicked');
        i++;
        var input = '';

        input += '<div class="no-padding" style="margin-bottom:10px;" id="photo-'+i+'">' 
            input += '<div class="form-group">';
                input += '<div class="col-sm-8 col-xs-12 no-padding">';
                    input += '<img id="data'+i+'" class="col-sm-3 col-xs-5 no_pad_left" />';
                    input += '<span id="info'+i+'" class="no_pad_left col-sm-6 col-xs-7"></span>';
                input += '</div>'; 
                    
                input += '<div class="clear"></div>';

                input += '<div class="col-xs-11 no-padding" style="padding-left:0px; padding-right:0px;">'; 
                    input += '<input class="form-control photo" type="file" id="photo_'+i+'" data-id="data'+i+'" name="photo[]" />';
                    input += '<input class="form-control" type="text" name="photo_title[]" placeholder="Photo name/Title" />';
                input += '</div>';
                input += '<div class="col-xs-1 no-padding" style="padding-left:0px; padding-right:0px;">';
                    input += '<button type="button" class="form-control btn btn-danger" data-id="photo-'+i+'">X</button>';
                input += '</div>'; 
            input += '</div>';//End of form-group

            input += '<div class="col-xs-12" style="margin-bottom:10px;"><hr/></div>';
            input += '<div class="clear"></div>';
                
        input += '</div>';  //End of id="photo-id" 

        $('#photo-inputs').append(input);
        if(i >= 5) {
            $('#add-more').css('display', 'none');
        }
        //alert('i: '+i);  
    })
            
    $(document).on('click', '#photo-inputs button', function(e) { 
        //Removes a photo input when clicked
        var id = $(this).data('id');
        $('#'+id).remove();
        $(this).remove();
        i--;
        //alert('i: '+i);
        if(i <= 5){
            $('#add-more').css('display', 'block');
        }
    });

    $(document).on('click', '.edit-control', function() {
    	var id = $(this).data('id');
    	var open = $(this).data('open');
        var button = $(this);
        
    	if(open==0) {
    		$('#control-group-'+id).css('display', 'none');
    		$('#photo_title-'+id).css('display', 'none');
    		$('#edit-form-'+id).css('display', 'block');
    		button.data('open', '1');
            button.html('Close');
    	}else{
    		$('#edit-form-'+id).css('display', 'none');
    		$('#info'+id).css('display', 'none');
    		$('#close-btn').remove();
    		$('#edit-form-'+id+' form input[type=reset]').trigger('click');
    		$('#control-group-'+id).css('display', 'block');
    		$('#photo_title-'+id).css('display', 'block');
            button.data('open', '0');
            button.html('Edit');
    	}
    })

    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var alert_message = $('#estate-photo-message');
        $.ajax({
			url:"{{url('realtor/delete_estate_photo')}}", 
			data:{id: id, _token: CSRF_TOKEN}, 
			type: "post", 
			async: false, 
			success: function(data) { 
                console.log(data);
                //alert(data.status_code);
                if(data.status_code==200) {
				    $('#photo-'+id).remove();
                    alert_message.removeClass('alert-danger')
                    alert_message.addClass('alert-success');
                    alert_message.html(data.message);
                    alert_message.css('display','block');
                }else{
                    alert_message.removeClass('alert-success')
                    alert_message.addClass('alert-danger');
                    alert_message.html(data.message);
                    alert_message.css('display','block');
                }
			}
		})
        
    })
});
</script>

@endsection