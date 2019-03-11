
<div class="rinfo_public" id="realtor-details">
    <div class="rinfo_public__cover">
        <h4 class="rinfo_public__cover__1st m-0">
            @if($realtor->type=='company') {{$realtor->biz_name}} @else {{$realtor->full_name}} @endif
        </h4>
        <h5 class="rinfo_public__cover__2nd m-0">{!! $realtor->type == 'company' ? 'Real Estate Firm' : 'Agent' !!}</h5>
        <h5 class="rinfo_public__cover__3rd m-0">{!! $realtor->verified == 1 ? 
        '<span class="verified"><i class="fa fa-check"></i> Verified </span>' : 
        '<span class="not_verified"><i class="fa fa-times"></i> Not Verified </span>' !!}
        </h5>
        <hr class="mb-1">

        <h5 class="rinfo_public__cover__4th m-0"><i class="fa fa-envelope"></i> {{$realtor->email}}</h5>
        <h5 class="rinfo_public__cover__5th m-0"> <i class="fa fa-phone"></i>
            <?php $i = 0; ?>
                @foreach($realtor->phones as $realtorPhone)
                    {{$realtorPhone->phone}} 
                    <?php $i++; ?>

                    @if($i < $realtor->phones->count())
                        ,
                    @endif
                @endforeach
        </h5>
        @if($realtor->address != '')
        <h5 class="rinfo_public__cover__6th m-0"><i class="fa fa-address-book"></i>
            {{$realtor->address}}
        </h5>
        @endif
    </div>
    <div class="row rinfo_public__fh">
        <div class="col-6 pr-0">
            <div class="rinfo_public__fh__f">   
                <div class="">{{$realtor->followers->count()}}</div>     
                <div class=""><b>No of Followers </b></div>
            </div>
        </div> 
        <div class="col-6 pl-0"> 
            <div class="rinfo_public__fh__h">
                <div class="">{{$allRealtor_houses->count()}}</div>       
                <div class=""><b>No of Houses </b></div> 
            </div>
        </div> 
    </div>
</div>
