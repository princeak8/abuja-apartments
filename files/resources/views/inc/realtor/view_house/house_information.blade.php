<div class="house_information">
    @if(request()->session()->exists('edit_house'))
        <p class="alert alert-success">{{session('edit_house')}} </p>
    @endif
    <h5 id="drop_des" class="house_information__title"> House Information 
        {{-- <i class="fa fa-caret-down"></i>  --}}
        {{-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#hz_informatn">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button> --}}
    </h5>
    {{-- <hr class="mt-0"> --}}
    <div id="hz_informatn" class="house_information__body">
        @include('inc.realtor.view_house.house_status')
        <ul class="">
            <div class="house_information__body__ls">
                <li class=""><small class="fa fa-map-marker-alt"></small> {{$house->location->name}} </li>
                <li>
                    <span>{{$house->status}}</span>
                </li>
            </div>
            <div class="house_information__body__price">
                <li class="">Name <small class="fa fa-angle-double-right"></small> {{$house->title}} </li>
                <li><small class="fa fa-tag"></small> Price <small class="fa fa-angle-double-right"></small> 
                @if(!empty($house->price))
                    ₦ {{number_format($house->price)}}
                @else
                    <span class="text-danger">N/A</span>
                @endif
                </li>
            </div>
            <div class="house_information__body__fee">
                <li>Agent Fee <small class="fa fa-angle-double-right"></small>
                    @if(!empty($house->agent_fee)) 
                        ₦ {{number_format($house->agent_fee)}} 
                    @else
                        <span class="text-danger">N/A</span>
                    @endif
                </li>
                <li>Service Charge <small class="fa fa-angle-double-right"></small> 
                    @if(!empty($house->service_charge))
                        ₦ {{number_format($house->service_charge)}} 
                    @else
                        <span class="text-danger">N/A</span> 
                    @endif
                </li>
            </div>
            <div class="house_information__body__2nd">
                <li class=""><span class="fa fa-clone"></span> House Type 
                    <small class="fa fa-angle-double-right"></small> {{$house->house_type->type}} 
                </li>
            </div>
            
            <div class="house_information__body__fee">
                <li><i class="fa fa-bed"></i> Bedrooms: {{$house->bedrooms}} </li>
                <li>
                    Total Rooms: 
                    @if(!empty($house->rooms)) 
                        {{$house->rooms}}
                    @else 
                        <span class="text-danger">N/A</span> 
                    @endif
                </li>
            </div> 
            <div class="house_information__body__fee">   
                
                <li><i class="fa fa-bath"></i> 
                    Toilets: 
                    @if(!empty($house->toilets))
                        {{$house->toilets}} 
                    @else
                        <span class="text-danger">N/A</span>
                    @endif 
                </li>
                <li><i class="fa fa-shower"></i> 
                    Bathrooms: @if(!empty($house->bathrooms))
                                {{$house->bathrooms}} 
                            @else
                                <span class="text-danger">N/A</span>
                            @endif 
                </li>
            </div>
            <div class="house_information__body__ws"> 
                <li>
                    <i class="fa fa-tint"></i> Water Source <small class="fa fa-angle-double-right"></small>
                     @if(!empty($house->water_source))
                        {{$house->water_source}}
                    @else
                        <span class="text-danger">N/A</span>
                    @endif 
                </li> 
                
            </div>
        </ul>
        
        @if($house->status=='sale')
        <div class="col-12 house_information__body__details">
            <div class="house_information__body__details__title">Sales' Plan <small class="fa fa-caret-down"></small> </div>
            <div class="house_information__body__details__body">
                
                    @if(!empty($house->sale_plan)) 
                        <?php echo $house->sale_plan; ?>
                    @else
                        <span class="text-danger">N/A</span>
                    @endif
                 
            </div>
        </div>
        @endif

        <div class="col-12 house_information__body__details">
            <div class="house_information__body__details__title">Facilities <small class="fa fa-caret-down"></small> </div>
            <div class="house_information__body__details__body">
                
                @if(!empty($house->facilities))
                    {!! $house->facilities !!}
                @else
                    <span class="text-danger">N/A</span>
                @endif
                 
            </div>
        </div>

        <div class="col-12 house_information__body__details">
            <div class="house_information__body__details__title">Description <small class="fa fa-caret-down"></small> </div>
            <div class="house_information__body__details__body">
                
                    @if(!empty($house->description))
                        {!! $house->description !!} 
                    @else
                        <span class="text-danger">N/A</span>
                    @endif
                 
            </div>
        </div>

        @if(!$house->is_shared(Auth::user()->id))
        <div class="info_edit">
            <a class="btn btn-primary col-12" href="{{url('realtor/edit_house/'.$house->id)}}">
                <i class="fa fa-edit"></i> Edit House Information
            </a>
        </div>
        @endif
    </div>
</div>