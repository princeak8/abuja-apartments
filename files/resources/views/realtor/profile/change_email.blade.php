

{{-- @extends('layouts.realtor_profile', ['page'=>'change email']) --}}
@extends('layouts.realtor')

@section('content')
    <div class="row">
        @include('inc.realtor.profile_left_menu', ['page'=>'change email'])
    
        <div class="col-9">
            <h3>Change Email <i class="fa fa-caret-down"></i></h3>
            <p>@include('inc.errors')</p>
            
            @if(request()->session()->exists('msg'))
                <p class="@if(session('status')=='success') alert-success @else alert-danger @endif">{{session('msg')}} </p>
            @endif
            
            {!! Form::model($realtor, ['action' => ['Realtor\ProfileController@update_email'], 'method'=>'PATCH']) !!}
                <div class="form-group">
                    <div class="col-sm-3 col-md-2">
                        <label for="email">Current Email:</label>
                    </div>
                    <div class="col-sm-9 col-md-10">
                        {!! Form::text('email', null, ['placeholder'=>'CURRENT EMAIL', 'id'=>'email', 'class'=>'form-control', 'required']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-2 col-sm-3">
                        <label for="new_email">New Email:</label>
                    </div>
                    <div class="col-sm-9 col-md-10">
                        {!! Form::text('new_email', null, ['placeholder'=>'NEW EMAIL', 'id'=>'new_email', 'class'=>'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-2 col-sm-3">
                        <label for="password">Password:</label>
                    </div>
                    <div class="col-sm-9 col-md-10">  
                        {!! Form::password('password', ['placeholder'=>'PASSWORD', 'id'=>'title', 'class'=>'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-md-10 col-md-offset-2 col-sm-offset-3">
                        <button type="submit" name="submit" value="Change" class="btn-info form-control"><i class="fa fa-check-square"></i> Change Email</button>
                        <!--<input type="submit" name="submit" value="Change" class="btn-info form-control" />-->
                    </div>
                </div>  
            </form>
        </div>
    </div>

@endsection

@section('js')


@endsection