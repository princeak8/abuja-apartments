@if(Auth::user()->type=='company')
	@include('inc.realtor.company_head_links')
@else
	@include('inc.realtor.agent_head_links')
@endif

@extends('layouts.realtor_profile', ['page'=>'change password'])

@section('content')

    <h3>
        @if(empty($realtor->profile_photo))
            Upload Profile Photo <i class="fa fa-caret-down"></i>
        @else
            Change Profile Photo <i class="fa fa-caret-down"></i>
        @endif
    </h3>
    <p>@include('inc.errors')</p>
	
	@if(request()->session()->exists('msg'))
	    <p class="@if(session('status')=='success') alert-success @else alert-danger @endif">{{session('msg')}} </p>
	@endif

    <div class="col-sm-4">
        <img class="img-thumbnail img-responsive" src="{{env('APP_STORAGE')}}images/profile_photos/{{$realtor->profile_photo}}" width="150" height="100" />
    </div>

    {!! Form::model($realtor, ['action' => ['Realtor\ProfileController@update_profile_photo'], 'method'=>'PATCH', 'enctype'=>'multipart/form-data', 'autocomplete'=>'off']) !!}
        <!-- Settings to remove auto-complete/suggestion -->
        <input autocomplete="off" type="text" style="display:none" />
        <input type="text" style="display:none">
        <input type="password" style="display:none">
        

        <div class="form-group">
            <div class="col-sm-12">
                <i class="red">Max of 2mb</i>
             	<input type="file" name="photo" class="form-control" placeholder="PROFILE PHOTO" required />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3 col-md-2">
                <label for="email">Email:</label>
            </div>
            <div class="col-sm-12 col-md-12">
                {!! Form::text('email', null, ['placeholder'=>'EMAIL', 'id'=>'email', 'class'=>'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2 col-sm-3">
                <label for="password">Current Password:</label>
            </div>
            <div class="col-sm-12 col-md-12">  
                {!! Form::password('password', ['placeholder'=>'PASSWORD', 'id'=>'title', 'class'=>'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" name="submit" value="Change" class="btn-info form-control"><i class="fa fa-check-square"></i> Change Profile Photo</button>
            </div>
                    <!--<input type="submit" name="submit" value="Change" class="btn form-control" />-->
        </div>
    {!! Form::close() !!}

@endsection

@section('js')


@endsection