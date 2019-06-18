@if(!$house->is_shared(Auth::user()->id)) <?php //If the house is not a shared house, Go ahead and share if you wish ?>
<div class="house_information__body__status">
    
        @if($realtorHouse->available==1)
        <p class="status m-0 available">
            This House is available
        </p>
        @else
        <p class="status m-0 unavailable">
            This House is unavailable
        </p>
        @endif
    
    <div class="aval1 house_information__body__status__availability" >
        
        <div id="availability" class="house_information__body__status__availability__change" data-id="{{$house->id}}">
            @if($realtorHouse->available==1)
                <button type="button" data-id="0" class="btn btn-danger btn-sm"> Make this house unavailable</button>
            @endif
            @if($realtorHouse->available==0)
                <button type="button" data-id="1" class="btn btn-success btn-sm"> Make this house available</button>
            @endif    
        </div>
        <div id="avail_share" class="share">
            @if($realtorHouse->available==1)      
                <a href="{{url('realtor/share_house/'.$house->id)}}" >
                    <button type="button" class="btn btn-info btn-sm">
                        <i class="fas fa-share"></i> Share This House
                    </button> 
                </a>
            @endif
        </div>
    </div>
    
    
</div>
@endif