<div class="filter__body__bedrooms">
    <div class="filter-header" id="bedrooms">
        <h4>No Of Bedrooms <span class="fa fa-angle-down hi"></span>
            {{-- <button type="button" class="navbar-toggle" data-toggle="" data-target="">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> --}}
        </h4>
    </div>
                        
    
    <div id="no_room" class="filter__body__bedrooms__body" style="display: none;">
        <label class="control__radio">
            <input type="radio" checked name="bedrooms" value="all" /> All 
            <div class="control__indicator"></div>
        </label>
        <div class="clearfix"></div>
                    
        <?php for($i=1; $i<6; $i++) { ?>
            <label class="control__range">
                <input type="checkbox" name="bedrooms" value="<?php echo $i; ?>" data-id="<?php echo $i; ?> Bedroom(s)" />
                <?php echo $i; ?>
                <div class="control__indicator"></div>
            </label>
        <?php } ?>
        <div class="clear"></div>
    </div>
</div>