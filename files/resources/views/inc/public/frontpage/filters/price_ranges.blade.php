<div class="filter__body__price-ranges">
    <div class="filter-header" id="price-ranges">
        <h4>Price Ranges <span class="fa fa-angle-down hi"></span>
            {{-- <button type="button" class="navbar-toggle" data-toggle="" data-target="">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> --}}
        </h4>
    </div>
    
    <div class="filter__body__price-ranges__body fold_range" style="display: none;">
        <div id="range" class="no-padding">
            <label class="control__radio">
                <input type="radio" checked name="price_range_id" value="all" /> All 
                <div class="control__indicator"></div>
            </label>
            <br/>
            @foreach($price_ranges as $price_range) 
                <label class="control__range">
                    <input type="checkbox" name="price_range_id" value="{{$price_range->id}}" data-id="{{$price_range->display}}" /> {{$price_range->display}} <br/>
                    <div class="control__indicator"></div>
                </label>
                <br/>
            @endforeach
        </div>
    </div>
</div>