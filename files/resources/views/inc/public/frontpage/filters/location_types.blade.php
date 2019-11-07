<div class="filter__body__location-types">
    <div class="filter-header" id="location-types" style="cursor: pointer">
        <h4>Locations <span class="fa fa-angle-down hi"></span>
            {{-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> --}}
        </h4>
    </div>
    
    <div id="location" class="filter__body__location-types__body" style="display: none;">
        <label class="control__radio">
            <input type="radio" checked name="location_id" value="all" /> All <br/>
            <div class="control__indicator"></div>
        </label>
                
        @foreach($locations as $location)
            <label class="control__range">
                <input type="checkbox" name="location_id" value="{{$location->id}}" data-id="{{$location->name}}" /> {{$location->name}} <br/>
                <div class="control__indicator"></div>
            </label>
        @endforeach
    </div>
</div>