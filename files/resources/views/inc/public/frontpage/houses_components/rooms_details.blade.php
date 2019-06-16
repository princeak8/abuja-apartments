<div class="house__upper__bath">
    <ul>
        <li><span class="fa fa-bed"></span> {{$house->bedrooms}} 
            @if($house->bedrooms <= 1)
                    bedroom
            @else
                    bedrooms
            @endif
        </li>
        <li><span class="fa fa-shower"></span> {{$house->bathrooms}} 
            @if($house->bathrooms <= 1) 
                    bathroom
            @else
                    bathrooms
            @endif
        </li>
        <li><span class="fa fa-bath"></span> {{$house->toilets}} 
            @if($house->toilets <= 1) 
                    toilet
            @else
                    toilets
            @endif
        </li>
    </ul>
</div>