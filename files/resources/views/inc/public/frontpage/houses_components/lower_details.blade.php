<div class="house__details">
    <div class="house__details__upper">
        <ul>
            
            <li><i class="fa fa-tag"></i> {!! check_string_length($house->title) !!}</li>
            <li><i class="fa fa-clone"></i> {{check_string_length($house->house_type->type)}}</li>
            @if($house->estate_id > 0) 
                <li><i class="fa fa-list-ul"></i> {{check_string_length($house->estate->name)}}
                    (<span>{{$house->units}} Units</span>)
                </li>        
            @endif
        </ul>
        {{-- <a href="house/{{$house->id}}">
            <span class="fa fa-external-link"></span> View details <span class="fa fa-angle-double-right"></span> 
        </a> --}}
    </div>
    <hr>
    <div class="house__details__lower">
        
        <div class="house__details__lower__rs text-capitalize">
            For {{$house->status}}
        </div>
        <div class="house__details__lower__cl">
            <span><i class="fa fa-thumbs-up"></i> Likes {{count($house->house_likes)}}</span>
            <span><i class="fa fa-comments"></i> Comments {{count($house->house_comments)}}</span>
        </div>
    </div>
</div>