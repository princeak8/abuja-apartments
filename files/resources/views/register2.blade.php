@extends('layouts.public')


@section('content') 
    <div class="container-fluid bg_white login_page">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($type=='individual')
                        <h4 class="panel-title"><span class="fa fa-edit"></span> REGISTRATION PAGE</h4>
                    @else
                        <h4 class="panel-title"><span class="fa fa-edit"></span> COMPANY REGISTRATION PAGE</h4>
                    @endif
                </div>
                <div class="panel-body col-md-10 offset-md-1">

                    <p>@include('inc.errors')</p>
                    @if(request()->session()->exists('msg'))
                        <p class="@if(session('status')=='success') alert-success @else alert-danger @endif">{{session('msg')}} </p>
                    @endif

                    <div class="col-sm-12 nopad-xs no-margin info_mes">
                        @if($type=='individual')
                            <p><b>If You Are a Real Estate Firm, Please Register <a href="{{url('realtor/register/company')}}">HERE</a></b></p>
                        @endif
                        All Fields marked with red Asterix are compulsory<br/>
                        Spaces are not allowed in Profile name e.g instead of &nbsp;<span class=""> "James Bond(Not allowed)"</span> &nbsp;&nbsp;Use <span class=""> "JamesBond(allowed)"</span>
                    </div>
                    @if($type=='company')
                        {!! Form::open(['action' => ['Realtor\RegisterController@register_company'], 'method'=>'POST', 'autocomplete'=>'off']) !!}
                    @else
                        {!! Form::open(['action' => ['Realtor\RegisterController@register'], 'method'=>'POST', 'autocomplete'=>'off']) !!}
                    @endif
                        <input autocomplete="off" type="text" style="display:none" />
                        <input type="text" style="display:none">
                        <input type="password" style="display:none">

                        <div class="form-group col-md-4 col-sm-4 no-padding">
                            <b class="red">* </b><label for="firstname">@if($type=='individual') First @else Company @endif Name:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">fn</span>
                                <input id="firstname" class="form-control input-sm" type="text" name="firstname" placeholder="FIRST NAME" required value="{!! old('firstname') !!}" />
                            </div>  
                        </div>

                        @if($type=='individual')
                            <div class="form-group col-sm-4 nopad-xs">
                                <b class="red">* </b><label for="lastname">Last Name:</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">LN</span>
                                    <input id="lastname" class="form-control input-sm" type="text" name="lastname" placeholder="LAST NAME" required value="{!! old('lastname') !!}" />
                                </div>  
                            </div>
                        @endif

                        @if($type=='company')
                            <div class="form-group col-sm-4 nopad-xs">
                                <b class="red">* </b><label for="rc_number">RC NUMBER:</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">RN</span>
                                    <input id="rc_number" class="form-control input-sm" type="text" name="rc_number" placeholder="RC NUMBER OF THE COMPANY" required value="{!! old('rc_number') !!}" />
                                </div>  
                            </div>
                        @endif

                        <div class="form-group col-sm-4 nopad-xs">
                            <b class="red">* </b><label for="profile_name">Profile Name(This will be used to form your personal Page):</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                <input id="profile_name" class="form-control input-sm" type="text" name="profile_name" placeholder="PROFILE NAME" required value="{!! old('profile_name') !!}" data-error="0" />
                            </div>  
                        </div>

                        <div class="form-group col-sm-4 no-padding">
                            <b class="red">* </b><label for="email">Email: </label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                <input id="email" class="form-control input-sm" type="email" name="email" placeholder="EMAIL" required value="{!! old('email') !!}" />
                            </div>  
                        </div>

                        <div class="form-group col-sm-4 nopad-xs">
                            <b class="red">* </b><label for="password">Password<i class="red"> (Min of 7 Characters)</i>: </label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                <input class="form-control input-sm" type="password" name="password" placeholder="PASSWORD" required data-error="0" />
                            </div>  
                        </div>
                            
                        <div class="form-group col-sm-4 nopad-xs">
                            <b class="red">* </b><label for="phone">Phone Number: </label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone"></i></span>
                                <input id="phone" class="form-control input-sm" type="text" name="phone" placeholder="PHONE NUMBER" required value="{!! old('phone') !!}" />
                            </div>  
                        </div>

                        <input type="hidden" name="type" value="agent" />
                        <div class="form-group col-sm-12 nopad-xs">
                        <input class="btn btn-info form-control" type="submit" name="submit" value="REGISTER" />
                        </div>

                    </form>

                    <div id="terms" class="col-sm-12 nopad-xs">
                        <h4>
                            By registering you accept our <a href="../terms.php">Terms of Use</a> and <a href="../privacy.php">Privacy</a> and agree that we and our selected partners may contact you with relevant offers and services.
                        </h4>
                    </div>

                </div><!-- End of the panel-body -->
            
                <div class="clear"></div>
            </div>  
        </div>  
            
    </div>

@endsection