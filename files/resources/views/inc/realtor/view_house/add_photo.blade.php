<div class="row no-margin ad_photo border border-danger"> 
    <p>@include('inc.errors')</p>
    
    @if(request()->session()->exists('add-photo-error'))
        <p class="alert-danger">{{session('add-photo-error')}} </p>
    @endif  
    @if(!$house->is_shared(Auth::user()->id))
        <button class="col-md-6 btn btn-primary" id="add-photo-btn" data-open="0">Add Photo</button> 
        <div id="add-photo-form" class="col-md-12" style="border: medium #ccc inset; display: none;">
            {!! Form::open(['action' => ['Realtor\PhotoController@save_house_photo'], 'method'=>'POST',  'enctype'=>"multipart/form-data"]) !!}
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
                    <input type="hidden" name="house_id" value="{{$house->id}}"> 
                    <input class="form-control btn btn-info" type="submit" name="submit" value="Submit" />
                </div>
            {!! Form::close() !!}
        </div>
    @endif 
</div>