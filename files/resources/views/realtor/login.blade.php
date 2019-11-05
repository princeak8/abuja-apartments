@extends('layouts.public', ['page'=>'Login'])

@section('content')
<div class="container-fluid login">
    <div class="login__container col-lg-5 col-12">   	
        <h4 class="login__container__title">
            <span> Login </span>
        </h4>

        <div class="login__container__body">
                @if(request()->session()->exists('register'))
                <p class="alert-success">{{session('register')}} </p>
            @endif
            <?php //echo $request->session()->token(); ?>
            <p>
                @include('inc.errors')
            </p>
            <form action="{{url('realtor/login')}}" autocomplete="false" method="POST" accept-charset="utf-8" class="login__container__body__form">
                {{ csrf_field() }}
                
                <div class="login__container__body__form__input">
                    
                    <input id="email" class="form-control form-control-sm" autocomplete="false" type="text" name="email" value="{{ old('email') }}" required />
                    <label for="email">Email/Profile Name</label>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="login__container__body__form__input">
                    
                    <input id="password" class="form-control form-control-sm" autocomplete="false" type="password" name="password" required />
                    <label for="password">Password</label>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif    
                </div>
                
                    @if(isset($redirect)) 
                        <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                    @endif
                <div class="">    
                    {{-- <input class="form-control btn btn-info" type="submit" name="submit" value="LOGIN" /> --}}
                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <p class="">
                <span>Sign Up <a href="{{'realtor/register'}}">Individual</a>  | <a href="{{'realtor/register/company'}}">Company</a> </span>
                <span>Lost Password? Get new one <a href="{{url('forgot_password')}}">Here</a></span>
            </p>
        </div>
    </div>
        
</div>

@endsection