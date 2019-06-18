@extends('layouts.frontpage')


@section('content') 

    <div class="circle_search" class="col-md-10 col-sm-offset-1">
        <p>
            Search Results For <i>"{{$searchValue}}"</i>
        </p>
        <table class="table table-stripped">
            <thead>
                <th>S/N</th>
                <th><span class="fa fa-photo"></span> Profile Photo</th>
                <th>Profile Name</th>
                <th>Name</th>
                <th></th>
            </thead>
            <tbody>
                <?php $n = 0; ?>
                @foreach($result as $foundRealtor) 
                    <?php $n++; ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td>
                            <a class="cap_1st" href="{{url($foundRealtor->profile_name)}}">
                                <img src="{{env('APP_STORAGE')}}images/profile_photos/@if(empty($foundRealtor->profile_photo))no_photo.jpg @else{{$foundRealtor->profile_photo}} @endif" width="110" height="80" />
                            </a>
                        </td>
                        <td>
                            <a class="cap_1st" href="{{url($foundRealtor->profile_name)}}">
                                {{$foundRealtor->profile_name}}
                            </a>
                        </td>
                        <td>
                            {{$foundRealtor->name}}
                        </td>
                        @if(Auth::user())
                            <td id="circle-request">
                            <!--  Conditions
                                    if the the realtor is not in his circle
                                    if circle request has not been sent
                                -->
                                @if(Auth::user()->id != $foundRealtor->id && Auth::user()->rship_exists($foundRealtor->id))
                                    @if(Auth::user()->request_sent($foundRealtor->id))
                                        <b class="green">Circle Request Sent | </b>
                                    @endif
                                @else
                                    <div style="display:inline-block;">
                                        <button type="button" id="add-to-circle-btn" class="btn-default" data-loading="0" data-accepter="{{$foundRealtor->id}}"" data-requester="{{Auth::user()->id}}"><span class="fa fa-rss"></span> Add to Circle</button>
                                        <!--<input type="submit" name="submit" value="Add to Circle" />-->
                                    </div>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('js') 
    @include('inc.public.circle_request_js')
@endsection
