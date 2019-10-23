@extends('layouts.public', ['page'=>'Password Recovery Secret'])

@section('content')
<div class="container-fluid login">
    <div class="login__container col-lg-5 col-12">   	
        <h4 class="login__container__title">
            <span><i class="fas fa-signin"></i> Forgot Password - Answer Secret Your Question</span>
        </h4>

        <div class="login__container__body">
                @if(request()->session()->exists('msg'))
                <p class="alert-danger">{{session('msg')}} </p>
            @endif
            <?php //echo $request->session()->token(); ?>
            <p>
                @include('inc.errors')
            </p>
            <form action="{{url('secret_question')}}" method="POST" accept-charset="utf-8" class="login__container__body__form">
                {{ csrf_field() }}
                
                <div class="login__container__body__form__input">
                    {{$question}}
                    <input id="answer" class="form-control form-control-sm" type="text" name="answer" value="{{ old('answer') }}" required />
                    <label for="email">Enter Answer</label>
                    @if ($errors->has('answer'))
                        <span class="help-block">
                            <strong>{{ $errors->first('answer') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="">    
                    {{-- <input class="form-control btn btn-info" type="submit" name="submit" value="LOGIN" /> --}}
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <p class="">
                <span>Login <a href="{{url('realtor/login')}}">Login</a></span>
            </p>
        </div>
    </div>
        
</div>

@endsection