<div class="house__upper__bath">
    <ul>
        <li><span class="fa fa-bed"></span> {{$house->bedrooms}} 
            {{($house->bedrooms <= 1) ? 'bedroom' : 'bedrooms'}}
        </li>
        <li><span class="fa fa-shower"></span> {{$house->bathrooms}}
            {{($house->bathrooms <= 1) ? 'bathroom' : 'bathrooms'}}
        </li>
        <li><span class="fa fa-bath"></span> {{$house->toilets}} 
            {{($house->toilets <= 1) ? 'toilet' : 'toilets'}}
        </li> 
    </ul>
</div>