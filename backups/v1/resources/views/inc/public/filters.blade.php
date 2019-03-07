<div id="left-side" class="col-md-12 col-sm-12">
    <div class="panel panel-default">	
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-filter"></i> FILTERS</h3>
        </div>  
        <div class="panel-body"> 
            <div class="no-padding">
                <label class="control_radio control--radio">
                    <input type="radio" name="status" value="all" checked /> All
                    <div class="control__indicator"></div>
                </label>

                <label class="control_radio control--radio">
                    <input type="radio" name="status" value="rent" data-id="Rent" /> Rent
                    <div class="control__indicator"></div>
                </label>

                <label class="control_radio control--radio">
                    <input type="radio" name="status" value="sale" data-id="Sale" /> Sale
                    <div class="control__indicator"></div>
                </label> 
            </div>

            <div id="house-types" class="col-sm-12 col-md-12 col-lg-12 no-padding">
                           
                <h4>House Types <span class="fa fa-angle-down hi"></span>
                    <button type="button" class="navbar-toggle" data-toggle="" data-target="">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </h4>
                <div class="fold" style="display: none;">
                    <div id="hs_type" class="no-padding" >
                        <label class="control_radio control--radio">
                            <input type="radio" checked name="house_type_id" value="all" /> All 
                            <div class="control__indicator"></div>
                        </label>
                        <br/>

                        @foreach($house_types as $house_type)
                            <label class="control_range control--checkbox">
                            	<input type="checkbox" name="house_type_id" value="{{$house_type->id}}" data-id="{{$house_type->type}}" /> {{$house_type->type}} 
                                <div class="control__indicator"></div>
                            </label>
                            <br/>
                        @endforeach
                                
                    </div>
                </div>
            </div>
            
            <!-- Location of Houses -->
            <div id="location-types" class="col-sm-12 col-md-12 col-lg-12 no-padding">
                           
                <h4>Locations <span class="fa fa-angle-down hi"></span>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </h4>
                <div id="location" class="no-padding" style="display: none;">
                    <label class="control control--radio">
                        <input type="radio" checked name="location_id" value="all" /> All <br/>
                        <div class="control__indicator"></div>
                    </label>
                            
                    @foreach($locations as $location)
                        <label class="control control--checkbox">
                            <input type="checkbox" name="location_id" value="{{$location->id}}" data-id="{{$location->name}}" /> {{$location->name}} <br/>
                            <div class="control__indicator"></div>
                        </label>
                    @endforeach
                </div>
            </div>
                    
            <div id="bedrooms" class="col-sm-12 col-md-12 col-lg-12 no-padding">
                           
                <h4>No Of Bedrooms <span class="fa fa-angle-down hi"></span>
                    <button type="button" class="navbar-toggle" data-toggle="" data-target="">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </h4>
                <div id="no_room" class="no-padding" style="display: none;">
                    <label class="control control--radio">
                        <input type="radio" checked name="bedrooms" value="all" /> All 
                        <div class="control__indicator"></div>
                    </label>
                    <div class="clear"></div>
                                
                    <?php for($i=1; $i<6; $i++) { ?>
                        <label class="control control--checkbox">
                            <input type="checkbox" name="bedrooms" value="<?php echo $i; ?>" data-id="<?php echo $i; ?> Bedroom(s)" />
                        <?php echo $i; ?>
                            <div class="control__indicator"></div>
                        </label>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
                    
            <div id="price-ranges" class="col-sm-12 col-md-12 col-lg-12 no-padding">
                <h4>Price Ranges <span class="fa fa-angle-down hi"></span>
                    <button type="button" class="navbar-toggle" data-toggle="" data-target="">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </h4>
                <div class="fold_range" style="display: none;">
                    <div id="range" class="no-padding">
                        <label class="control_radio control--radio">
                            <input type="radio" checked name="price_range_id" value="all" /> All 
                            <div class="control__indicator"></div>
                        </label>
                        <br/>
                        @foreach($price_ranges as $price_range) 
                            <label class="control_range control--checkbox">
                                <input type="checkbox" name="price_range_id" value="{{$price_range->id}}" data-id="{{$price_range->display}}" /> {{$price_range->display}} <br/>
                                <div class="control__indicator"></div>
                            </label>
                            <br/>
                        @endforeach
                    </div>
                </div>
            </div>
                    
        </div>   

    </div>    
</div>

<script type="application/javascript" src="{{asset('js/toggle_filters.js')}}"></script>