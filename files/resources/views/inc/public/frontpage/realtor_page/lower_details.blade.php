<div class="house__details">
    <div class="house__details__upper">
        <ul>
            <li><span class="fa fa-tag"></span> {!! check_string_length($house->title) !!}</li>

            <li><span class="fa fa-clone"></span> {!! check_string_length($house->house_type->type) !!}</li>
            @if($house->estate_id > 0 && $house->estate)
                <li><span class="fa fa-list-ul"></span> <?php echo check_string_length($house->estate->name); ?>
                    (<span>{{$house->units}} Units</span>)
                </li>  
            @endif
            
        </ul>
            
        {{-- <a href="{{url('house/'.$house->id)}}"><span class="fa fa-external-link"></span> 
            View details <span class="fa fa-angle-double-right"></span> </a>        --}}
    </div>
    <hr>
    <div class="house__details__lower">
        
            <div class="house__details__lower__rs text-capitalize">
                For {{$house->status}}
            </div>
            <div class="house__details__lower__cl">
                {{-- <span><i class="far fa-heart"></i> {{$house->likes}}</span>
                <span><i class="fa fa-comments"></i> {{$house->house_comments->count()}}</span> --}}
            </div>
    </div>

</div><!--End of Cont_descript -->