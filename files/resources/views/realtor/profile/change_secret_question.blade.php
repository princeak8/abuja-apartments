@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor_profile', ['page'=>'change password'])

@section('content')

    <h3>Change Secret Question <i class="fa fa-caret-down"></i></h3>
    <p>@include('inc.errors')</p>
	
	@if(request()->session()->exists('msg'))
	    <p class="@if(session('status')=='success') alert-success @else alert-danger @endif">{{session('msg')}} </p>
	@endif
    
    {!! Form::model($realtor, ['action' => ['Realtor\ProfileController@update_secret_question'], 'method'=>'PATCH', 'autocomplete'=>'off']) !!}
        <!-- Settings to remove auto-complete/suggestion -->
        <input autocomplete="off" type="text" style="display:none" />
        <input type="text" style="display:none">
        <input type="password" style="display:none">
        
        <div class="form-group">
            <div class="col-sm-3 col-md-2">
                <label for="email">Email:</label>
            </div>
            <div class="col-sm-9 col-md-10">
                {!! Form::text('email', null, ['placeholder'=>'EMAIL', 'id'=>'email', 'class'=>'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2 col-sm-3">
                <label for="password">Password:</label>
            </div>
            <div class="col-sm-9 col-md-10">  
                {!! Form::password('password', ['placeholder'=>'PASSWORD', 'id'=>'password', 'class'=>'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3 col-md-2">
                <label for="answer">
                    <span>New Question: </span>
                </label>
            </div>
            <div class="col-sm-9 col-md-10">
                {!! Form::text('new_question', null, ['placeholder'=>'New Question', 'id'=>'new_question', 'class'=>'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3 col-md-2">
                <label for="answer">
                    <span>Answer: </span>
                </label>
            </div>
            <div class="col-sm-9 col-md-10">
                {!! Form::text('new_answer', null, ['placeholder'=>'Answer', 'id'=>'answer', 'class'=>'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" name="submit" value="Change" class="btn-info form-control"><i class="fa fa-check-square"></i> Change Secret Question</button>
            </div>
                <!--<input type="submit" name="submit" value="Change" class="btn form-control" />-->
        </div>
    {!! Form::close() !!}

@endsection

@section('js')


@endsection