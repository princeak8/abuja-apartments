<div class="filter__body__house-types">
    
    <div class="filter__body__house-types__header filter-header" id="house-types">
       <h4>House Types <span class="fa fa-angle-down hi"></span>
            {{-- <button type="button" class="navbar-toggle" data-toggle="" data-target="">
                <span class="navbar-toggler-icon"></span>
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> --}}
        </h4> 
    </div>
                        
    
    <div class="filter__body__house-types__body" id="fold" style="display: none;">
        <div id="hs_type" class="" >
            <label class="control__radio">
                <input type="radio" checked name="house_type_id" value="all" /> All 
                <div class="control__indicator"></div>
            </label>
            <br/>

            @foreach($house_types as $house_type)
                <label class="control__range control--checkbox">
                    <input type="checkbox" name="house_type_id" value="{{$house_type->id}}" data-id="{{$house_type->type}}" /> {{$house_type->type}} 
                    <div class="control__indicator"></div>
                </label>
                <br/>
            @endforeach
                    
        </div>
    </div>
</div>