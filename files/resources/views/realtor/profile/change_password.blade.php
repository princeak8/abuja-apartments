@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor_profile', ['page'=>'change password'])

@section('content')

    <h3>Change Pasword <i class="fa fa-caret-down"></i></h3>
    <p>@include('inc.errors')</p>
	
	@if(request()->session()->exists('msg'))
	    <p class="@if(session('status')=='success') alert-success @else alert-danger @endif">{{session('msg')}} </p>
	@endif
    
    {!! Form::model($realtor, ['action' => ['Realtor\ProfileController@update_password'], 'method'=>'PATCH']) !!}
        <div class="form-group">
            <div class="col-sm-3 col-md-2">
                <label for="email">Email:</label>
            </div>
            <div class="col-sm-9 col-md-10">
                {!! Form::text('email', null, ['placeholder'=>'EMAIL', 'id'=>'email', 'class'=>'form-control', 'required']) !!}
            </div>
        </div>

        @if(!empty(Auth::user()->sec_question))
            <div class="form-group">
                <div class="col-sm-3 col-md-2">
                    <label for="answer">
                        </span>Sec Question: <span style="color:red">{{Auth::user()->sec_question}}?</span>
                    </label>
                </div>
                <div class="col-sm-9 col-md-10">
                    <input type="text" id="answer" name="answer" class="form-control" placeholder="ANSWER" required />
                </div>
            </div>
        @endif
              
        <div class="form-group">
            <div class="col-md-2 col-sm-3">
                <label for="password">Current Password:</label>
            </div>
            <div class="col-sm-9 col-md-10">  
                {!! Form::password('password', ['placeholder'=>'PASSWORD', 'id'=>'title', 'class'=>'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2 col-sm-3">
                <label for="new_password">New Password:</label>
            </div>
            <div class="col-sm-9 col-md-10">  
                {!! Form::password('new_password', ['placeholder'=>'NEW PASSWORD', 'id'=>'title', 'class'=>'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" name="submit" value="Change" class="btn-info form-control"><i class="fa fa-check-square"></i> Change Password</button>
            </div>
                <!--<input type="submit" name="submit" value="Change" class="btn form-control" />-->
        </div>
    {!! Form::close() !!}

@endsection

@section('js')


@endsection