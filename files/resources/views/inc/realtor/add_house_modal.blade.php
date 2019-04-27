<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New House</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="addhouse_container">
          <p>@include('inc.errors')</p>
          
          @if(request()->session()->exists('error'))
              <p class="alert alert-danger">{{session('error')}} </p>
          @endif

          {!! Form::open(['action' => ['Realtor\HouseController@save'], 'method'=>'POST',  'enctype'=>"multipart/form-data"]) !!}
            <!-- Form Field for the TITLE -->
            <div class="form-group">
              <label for="name"><b class="burgundy">* </b>Title or Address</label>
              <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
              <input id="name" type="text" name="title" class="form-control form-control-sm" required placeholder="Title or Address" value="{!! old('title') !!}" />
              </div>
            </div>

            <!-- Form-group containing three form fields LOCATION, HOUSE TYPE and NO OF BEDROOMS -->
            <div class="form-group row">
              <!--LOCATION OF HOUSE-->
                <div class="col-lg-4">
                
                  <label for="location"><b class="burgundy">* </b>Location</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-map-marker-alt"></i></div>
                      </div>
                      <select id="location" name="location_id" class="form-control form-control-sm" required >
                        <option value="">SELECT A LOCATION</option>
                          @foreach($locations as $location)
                          <option @if(old('location_id') && (old('location_id')==$location->id)) selected @endif value="{{$location->id}}"> {{$location->name}}</option>
                        @endforeach
                      </select>
                  </div>
                    
                </div>
                <!-- HOUSE TYPE -->
                <div class="col-lg-4">
                    <label for="type"><b class="burgundy">* </b>Type</label>
                      
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-home"></i></div>
                          </div>
                          <select id="type" name="house_type_id" class="form-control form-control-sm" required >
                            <option value="">SELECT HOUSE TYPE</option>
                              @foreach($house_types as $house_type)
                                <option @if(old('house_type_id') && (old('house_type_id')==$house_type->id)) selected @endif value="{{$house_type->id}}">
                                    {{$house_type->type}}
                                </option>
                              @endforeach
                          </select>
                      </div>
                </div>

                <!-- NO OF BEDROOMS -->
                <div class="col-lg-4" id="bedrooms">
                    <label for="bedrooms"><b class="burgundy">* </b>No of Bedrooms</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-bed"></i></div>
                        </div>
                        <input name="bedrooms" type="number" required class="form-control form-control-sm" id="bedrooms" size="2" maxlength="2" placeholder="No of bedrooms" value="{!! old('bedrooms') !!}" />
                    </div> 
                </div>

            </div><!-- End of Form-group --> 

            <!-- Form-group containing STATUS, AMOUNT and RESIDENTIAL -->
            <div class="form-group row">
            
              <!-- STATUS -->
              <div class="col-lg-4">
                <div class="row">
                  <div class="custom-control custom-radio col-6">
                    <input id="rent" type="radio" class="custom-control-input" name="status" value="rent" required @if(!old('status') || (old('status')!='sale')) checked @endif />&nbsp;&nbsp; 
                    <label class="custom-control-label" for="rent">Rent </label>
                  </div>
                  <div class="custom-control custom-radio col-6">
                    <input id="sale" class="custom-control-input" type="radio" name="status" value="sale" required @if(old('status') && (old('status')=='sale')) checked @endif />
                    <label class="custom-control-label" for="sale">Sale </label>
                  </div>
                </div>
              </div>
            
              <!-- PURPOSE -->
              <div class="col-lg-4">
                <div class="row">
                  <div class="custom-control custom-radio col-6">
                    <input id="residential" class="custom-control-input" type="radio" name="purpose" value="residential" required @if(!old('purpose') || (old('purpose')!='commercial')) checked @endif />&nbsp;&nbsp; 
                    <label class="custom-control-label" for="residential">Residential </label>
                  </div>

                  <div class="custom-control custom-radio col-6">
                    <input id="commercial" class="custom-control-input" type="radio" name="purpose" value="commercial" required
                    @if(old('purpose') && (old('purpose')=='commercial')) checked @endif/>
                    <label class="custom-control-label" for="commercial">Commercial </label>
                  </div>

                </div>
              </div> 
              
            </div>
            <!-- Form-group containing STATUS, AMOUNT and RESIDENTIAL Ends -->
            <div class="form-group eg">
              <label for="price"><b class="burgundy">* </b>Price <small id="per-anum">(Per Annum)</small></label>
              <div class="input-group">
                <div class="input-group-prepend p-0">
                  <span class="input-group-text py-0 px-3">₦</span>
                </div>
                <input id="price" type="number" min="50000" name="price" class="form-control form-control-sm" required value="{!! old('price') !!}" /> 
              </div>  
              <p class="form-text burgundy">E.g: 10000 (correct) not 10,000 (incorrect)</p>
            </div>

            <div class="addhouse_container__addphoto">

              <h4 class=""><span class="fa fa-photo"></span> Add House Photos </h4>
              <h5 class="burgundy">Maximum Photo Size allowed is 10MB</h5>

              <div id="photo-inputs" class="">  
                <div class="col-sm-8 col-xs-12">
                  <img id="data1" class="col-sm-3 col-xs-5 no_pad_left" />
                  <span id="info1" class="no_pad_left col-sm-6 col-xs-7" ></span>
                </div>
                
                <div class="form-group">
                  <input class="form-control photo form-control-sm" type="file" id="photo_1" data-id="data1" name="photo[]" required />
                  <input class="form-control form-control-sm" type="text" name="photo_title[]" placeholder="Photo Name/Title" />
                </div> 
              </div>

              <div id="add-more" class="form-group" style="margin-bottom: 5px;">
                <button type="button" class="btn btn-primary">Add More Photos</button>
              </div> 
            </div>

            <div class="form-group">  
              <input class="form-control btn btn-primary" type="submit" name="submit" value="Submit" />
            </div>

          {!! Form::close() !!}

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Submit</button> --}}
      </div>
    </div>
  </div>
</div>

@section('modaljs')
	@include('inc.realtor.add_photos_js')
	@include('inc.realtor.add_house_js')
@endsection