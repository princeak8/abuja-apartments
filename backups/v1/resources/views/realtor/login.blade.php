@extends('layouts.public', ['page'=>'view house'])

@section('content')
<div class="container-fluid bg_white login_page">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">	
                <h4 class="panel-title"><span class="fa fa-sign-in"></span> LOGIN PAGE</h4>
            </div>

            <div class="panel-body">
                 @if(request()->session()->exists('register'))
                    <p class="alert-success">{{session('register')}} </p>
                @endif
                <?php //echo $request->session()->token(); ?>
                    @include('inc.errors')
               
                </p>
            	<form action="{{url('realtor/login')}}" method="POST" accept-charset="utf-8">
            		{{ csrf_field() }}
                    
                    <div class="form-group col-sm-6">

                        <label for="email" class="h4">Email (or Profile Name for Realtors):</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                            <input id="email" class="form-control" type="text" name="email" placeholder="EMAIL" value="{{ old('email') }}" required />
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="password" class="h4">Password:</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            <input id="password" class="form-control" type="password" name="password" placeholder="PASSWORD" required />
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>
                    
                        @if(isset($redirect)) 
                        	<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                        @endif
                    <div class="form-group col-sm-12">    
                        <input class="form-control btn btn-info" type="submit" name="submit" value="LOGIN" />
                    </div>
                </form>
                <p class="col-sm-12">
                	<i>Not Registered yet? Register Here <a href="register.php">Individual</a>  | <a href="company_register.php">Company</a> </i>
                    <i style="margin-left:2%">Lost Password? Get new one <a href="forgot_password.php">Here</a></i>
                </p>
            </div>

        </div>
    </div>
        
</div>

@endsection