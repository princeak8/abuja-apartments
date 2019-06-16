<div class="col-sm-12 mt-2">
    <h5>Awaiting Approval</h5>
    @if(request()->session()->exists('circle_success'))
        <p class="alert alert-danger">{{session('circle_success')}} </p>
    @endif
    @if(request()->session()->exists('circle_error'))
        <p class="alert alert-danger">{{session('circle_error')}} </p>
    @endif

    @if(Auth::user()->circle_requests()->count()==0)
        <p>There Are No Circle Requests awaiting your approval</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>S/N</th>
                    <th>Realtor Name</th>
                    <th>Date Sent</th>
                    <th>Action</th>
                </thead>
                <tbody class="bg_white">
                <?php $n = 0; ?> 
                    @foreach(Auth::user()->circle_requests() as $request) <?php $n++; ?>
                        @if($request->user_one==Auth::user()->id)
                            <?php $requester = $request->user_two; ?>
                        @else
                            <?php $requester = $request->user_one; ?>
                        @endif
                    <tr>
                        <td>{{$n}}</td>
                        <td>{{\App\Realtor::find($requester)->full_name}}</td>
                        <td>{{$request->created_at}}</td>
                        <td>
                            {!! Form::open(['action' => ['Realtor\CircleController@process_request'], 'method'=>'POST', 'style'=>"display:inline-block"]) !!}
                                <input type="hidden" name="circle_id" value="{{$request->id}}" />
                                <input type="hidden" name="id" value="{{$request->action_user}}" />
                                <input type="hidden" name="action" value="accept" />
                                <input class="no_bor btn-success" type="submit" name="submit" value="Accept" onclick="return confirm('Are You sure that you want to accept this circle Request?')" />
                            {!! Form::close() !!}
                            {!! Form::open(['action' => ['CircleController@process_request'], 'method'=>'POST',  'style'=>"display:inline-block"]) !!}
                                <input type="hidden" name="circle_id" value="{{$request->id}}" />
                                <input type="hidden" name="id" value="{{$request->action_user}}" />
                                <input type="hidden" name="action" value="decline" />
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