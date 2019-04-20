{!! Form::open(['action' => ['Realtor\PhotoController@update_house_photo'], 'method'=>'POST', 'enctype'=>"multipart/form-data"]) !!}
    <div class="form-group">
        <input class="form-control form-control-sm photo" type="file" id="photo_{{$photo->id}}" data-id="data{{$photo->id}}" name="photo" required />
        <input class="form-control form-control-sm" type="text" name="photo_title" value="{{$photo->title}}" />
    </div>
    <div class="form-group"> 
        <input type="hidden" name="photo_id" value="{{$photo->id}}"> 
        <input type="reset" value="reset" style="display: none;">
        {{-- <input class="form-control btn btn-primary" type="submit" name="submit" value="Submit" /> --}}
        <button class="btn btn-outline-primary btn-sm" type="button" name="submit" value="Submit">Submit</button>
    </div>
{!! Form::close() !!}