<div id="left-side" class="filter">
    	
    <div class="filter__header">
        <h4 class="filter__header__title">Filters</h4>
    </div>

    <div class="filter__body"> 
        <div class="filter__body__radio pl-3">
            <label class="filter__body__control__radio">
                <input type="radio" name="status" value="all" checked /> All
                <div class="control__indicator"></div>
            </label>

            <label class="filter__body__control__radio">
                <input type="radio" name="status" value="rent" data-id="Rent" /> Rent
                <div class="control__indicator"></div>
            </label>

            <label class="filter__body__control__radio">
                <input type="radio" name="status" value="sale" data-id="Sale" /> Sale
                <div class="control__indicator"></div>
            </label> 
        </div>

        @include('inc.public.frontpage.filters.house_types')
        
        <!-- Location of Houses -->
        @include('inc.public.frontpage.filters.location_types')
                
        @include('inc.public.frontpage.filters.bedrooms')
                
        @include('inc.public.frontpage.filters.price_ranges')  

    </div>   

        
</div>
