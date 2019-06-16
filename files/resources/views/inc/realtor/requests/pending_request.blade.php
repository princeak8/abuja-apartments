<div class="col-sm-12 mt-2">
            
    @if(Auth::user()->sent_requests()->count()==0)
        <p>There Are No Pending Requests</p> 
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>S/N</th>
                    <th>Realtor Name</th>
                    <th>Date Sent</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody class="bg_white">
                <?php $n = 0; ?>
                    @foreach(Auth::user()->sent_requests() as $request) <?php $n++; ?>
                        @if($request->user_one==Auth::user()->id)
                            @php $accepter = $request->userTwo; @endphp
                        @else
                            @php $accepter = $request->userOne; @endphp
                        @endif
                ?>
                        <tr>
                            <td>{{$n}}</td>
                            <td>{{$accepter->full_name}}</td>
                            <td>{{$request->created_at}}</td>
                            <td>
                                @if($request->action==0) 
                                    Pending 
                                @elseif($request->action==-1) 
                                    Declined 
                                @endif
                            </td>
                            <td>
                                @if($request->action==-1) 
                                    {!! Form::open(['action' => ['Realtor\CircleController@process_request'], 'method'=>'POST',  'style'=>"display:inline-block"]) !!}
                                        <input type="hidden" name="circle_id" value="{{$request->id}}" />
                                        <input class="no_bor btn-warning" type="submit" name="submit" value="Resend Request" />
                                    {!! Form::close() !!}
                                @endif
                                
                                {!! Form::open(['action' => ['Realtor\CircleController@process_request'], 'method'=>'POST',  'style'=>"display:inline-block"]) !!}
                                    <input type="hidden" name="circle_id" value="{{$request->id}}" />
                                    <input type="hidden" name="request_type" value="circle" />
                                    <input class="no_bor btn-danger" type="submit" name="submit" value="Cancel" />
                                {!! Form::close() !!}
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>