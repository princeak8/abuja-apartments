<div class="col-sm-12 mt-2">
    <h5>Pending Share Requests</h5>
    
    @if(Auth::user()->sent_share_requests()->count()==0) 
        <p>There Are No Pending Requests</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped">    
                <thead>
                    <th>S/N</th>
                    <th>Shared With</th>
                    <th>House</th>
                    <th>Date Sent</th>
                    <th>Action</th>
                </thead>
                <tbody class="bg_white">
                <?php $n = 0; ?>
                    @foreach(Auth::user()->sent_share_requests as $request) <?php $n++; ?>
                        <tr>
                            <td>{{$n}}</td>
                            <td>{{$request->shared->full_name}}</td>
                            <td>
                                {{$request->house->title}}<br/>
                                <a href="{{url('realtor/house'.$realtor->house_id)}}" target="_blank">	
                                    View House
                                </a>
                            </td>
                            <td>{{\Carbon\Carbon::parse($request->created_at)->format('d/m/Y')}}</td>
                            <td>
                                @if($request->status==1) PENDING @else REJECTED @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            
            </table>
        </div>
    @endif
</div>

<div class="col-sm-12">
    <h5>Awaiting Approval</h5>
    @if(request()->session()->exists('share_error'))
        <p class="alert alert-danger">{{session('share_success')}} </p>
    @endif
    @if(request()->session()->exists('share_error'))
        <p class="alert alert-danger">{{session('share_error')}} </p>
    @endif

    @if(Auth::user()->share_requests()->count()==0) 
        <p>There Are No Requests awaiting your approval</p>
    @else
        <div class="table-responsive">
            <table class="table table-condensed">    
                <thead>
                    <th>S/N</th>
                    <th>Realtor Name</th>
                    <th>House</th>
                    <th>Date Sent</th>
                    <th>Action</th>
                </thead>
                <tbody class="bg_white">
                <?php $n = 0; ?>
                    @foreach(Auth::user()->share_requests as $request) <?php $n++; ?>
                        <tr>
                            <td>{{$n}}</td>
                            <td>{{$request->sharer->full_name}}</td>
                            <td>
                                {{$request->house->title}}<br/>
                                <a href="{{url('realtor/house'.$request->house_id)}}" target="_blank">	
                                    View House
                                </a>
                            </td>
                            <td>{{\Carbon\Carbon::parse($request->created_at)->format('d/m/Y')}}</td>
                            <td>
                                {!! Form::open(['action' => ['Realtor\HouseController@process_share_request'], 'method'=>'POST',  'style'=>"display:inline-block"]) !!}
                                    <input type="hidden" name="request_id" value="{{$request->id}}" />
                                    <input type="hidden" name="action" value="1" />
                                    <input class="no_bor btn-success" type="submit" name="submit" value="Accept" onclick="return confirm('Are You sure that you want to accept this house to be shared on your page?')" />
                                {!! Form::close() !!}
                                
                                {!! Form::open(['action' => ['Realtor\HouseController@process_share_request'], 'method'=>'POST',  'style'=>"display:inline-block"]) !!}
                                    <input type="hidden" name="requests_id" value="{{$request->id}}" />
                                    <input type="hidden" name="action" value="0" />
                                    <input class="no_bor btn-danger" type="submit" name="submit" value="Decline" />
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            
            </table>
        </div>
    @endif
</div>