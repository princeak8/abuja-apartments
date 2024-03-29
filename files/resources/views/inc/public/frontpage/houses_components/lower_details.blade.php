<div class="house__details mouseoverDetails">
    <a href="house/{{$house->id}}">
        <div class="house__details__upper">
            <ul>
                
                <li><i class="fa fa-tag"></i> {!! check_string_length($house->title) !!}</li>
                <li><i class="fa fa-clone"></i> {{check_string_length($house->house_type->type)}}</li>
                @if($house->estate_id > 0) 
                    <li><i class="fa fa-list-ul"></i> <?php echo check_string_length($house->estate->name); ?>
                        (<span>{{$house->units}} Units</span>)
                    </li>        
                @endif
            </ul>
            {{-- <a href="house/{{$house->id}}">
                <span class="fa fa-external-link"></span> View details <span class="fa fa-angle-double-right"></span> 
            </a> --}}
        </div>
    </a>
    <hr>
    <div class="house__details__lower">
        
        <div class="house__details__lower__rs text-capitalize">
            For {{$house->status}}
        </div>
        <div class="house__details__lower__cl">
            
            {{-- <span><i class="far fa-heart"></i>  {{count($house->house_likes)}}</span>
            <span><i class="ion-md-chatboxes"></i>  {{count($house->house_comments)}}</span> --}}
        </div>
    </div>
</div>