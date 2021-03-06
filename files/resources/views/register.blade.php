@extends('layouts.public')


@section('content') 
<style type="style/css">
    .red-border {
        border: red solid thin;
    }
</style>
    <div class="container-fluid login">
        <div class="login__container col-lg-12 col-12">
            
                <h4 class="login__container__title">
                    <span>
                        @if($type=='individual') Sign up @else Company sign up @endif
                    </span>
                </h4>
                <div class="login__container__body">

                <div class="col-sm-12 nopad-xs no-margin info_mes">
                    @if($type=='individual')
                        <p><b>If You Are a Real Estate Firm, Please Register <a href="{{url('realtor/register/company')}}">HERE</a></b></p>
                    @endif

                    
                        @if($type=='individual')
                            <p class="text-center mb-1 mt-3">If You Are a Real Estate Firm, Please Register <a href="{{url('register/company')}}">Here</a></p>
                        @endif
                        <p class="text-center">
                        {{-- All Fields marked with red Asterix are compulsory<br/> --}}
                        Spaces are not allowed in Profile name e.g instead of &nbsp;<span class=""> "James Bond(Not allowed)"</span> &nbsp;&nbsp;Use <span class=""> "JamesBond(allowed)"</span>
                        </p>

                        @include('inc.errors')
                        
                        @if($type=='company')
                            {!! Form::open(['action' => ['Realtor\RegisterController@register_company'], 'method'=>'POST', 'class'=>'login__container__body__form', 'autocomplete'=>'off' , 'onsubmit'=>'return submit_form(event)']) !!}
                        @else
                            {!! Form::open(['action' => ['Realtor\RegisterController@register'], 'method'=>'POST', 'class'=>'login__container__body__form', 'autocomplete'=>'off', 'onsubmit'=>'return submit_form(event)']) !!}
                        @endif
                        <input autocomplete="off" type="text" style="display:none" />
                        <input type="text" style="display:none">
                        <input type="password" style="display:none">
                        
                        {{-- <div class="form-group col-sm-4 no-padding">
                            <b class="red">* </b><label for="firstname">@if($type=='individual') First @else Company @endif Name:</label>
                            <div class="input-group">
                                <input id="firstname" class="form-control input-sm" type="text" name="firstname" placeholder="FIRST NAME" required value="{!! old('firstname') !!}" />
                            </div>  
                        </div> --}}
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="login__container__body__form__input">
                                    
                                    <input id="firstname" class="form-control input-sm" type="text" name="firstname" value="{{ old('firstname') }}" required />
                                    <label for="firstname"><span class="text-danger">* </span>@if($type=='individual') First @else Company @endif Name</label>
                                    {{-- @if ($errors->has('firstname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif --}}
                                </div>
                            </div>

                            @if($type=='individual')
                                <div class="form-group col-sm-4">
                                    <div class="login__container__body__form__input">
                                        <input id="lastname" class="form-control input-sm" type="text" name="lastname" required value="{!! old('lastname') !!}" />
                                        <label for="lastname"><span class="text-danger">* </span>Last Name</label>
                                    </div> 
                                </div>
                            @endif
                            @if($type=='company')
                                <div class="form-group col-sm-4">
                                    <div class="login__container__body__form__input">
                                        <input id="rc_number" class="form-control input-sm" type="text" name="rc_number" required value="{!! old('rc_number') !!}" />
                                        <label for="rc_number"><span class="text-danger">* </span>RC number</label> 
                                    </div> 
                                </div>
                            @endif
                            <div class="form-group col-sm-4">
                                <sub id="profile-name-msg" class="mb-1" style="color:red; display:none">
                                    Profile name should be one word without any spaces
                                </sub>
                                <div class="login__container__body__form__input">
                                    <input id="profile_name" class="form-control input-sm" type="text" name="profile_name" required value="{!! old('profile_name') !!}" data-error="0" placeholder="" />
                                    <label for="profile_name" style="margin-top:0px;"><span class="text-danger">* </span>Profile Name: (To be used for your personal Page)</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <div class="login__container__body__form__input">
                                    <input id="email" class="form-control input-sm" type="email" name="email" required value="{!! old('email') !!}" />
                                    <label for="email"><span class="text-danger">* </span>Email</label>
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
                                <div class="login__container__body__form__input">
                                    <input id="password" class="form-control input-sm" autocomplete="off" type="password" name="password" required data-error="0" />
                                    <label for="password"><span class="text-danger">* </span>Password<small class="text-danger"> Min of 7 Characters</small></label>
                                </div>  
                            </div>
                        
                            <div class="form-group col-sm-4">
                                <div class="login__container__body__form__input">   
                                    <input id="phone" class="form-control input-sm" type="text" name="phone" required value="{!! old('phone') !!}" />
                                    <label for="password"><span class="text-danger">* </span>Phone number</label>
                                </div>      
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <div class="login__container__body__form__input">
                                    <input id="twitter" class="form-control input-sm" type="text" name="twitter" value="{!! old('twitter') !!}" />
                                    <label for="twitter">Twitter Handle</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="login__container__body__form__input">
                                    <input id="instagram" class="form-control input-sm" type="text" name="instagram" value="{!! old('instagram') !!}" />
                                    <label for="instagram">Instagram Handle</label>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="type" value="agent" />
                        <div class="">
                            <button class="btn btn-primary" type="submit" name="submit" >Sign up</button>
                        </div>

                    </form>

                    
                    <p class="mt-3 text-center">
                        By registering you accept our <a href="../terms.php">Terms of Use</a> and <a href="../privacy.php">Privacy</a> and agree that we and our selected partners may contact you with relevant offers and services.
                    </p>
                    

                </div><!-- End of the panel-body -->
            
                
              
        </div>  
            
    </div>

@endsection

@section('js')
    <script type="application/javascript">
        $('document').ready(function() {
            $('input[name=profile_name]').blur(function() {
                var val = $(this).val();
                console.log(val);
                if (/\s/.test(val)) {
                    // It has any kind of whitespace
                    $(this).css('border', 'red solid thin');
                    $('#profile-name-msg').css('display', 'block');
                    $('button[name=submit]').attr('disabled', 'true');
                }else{
                    $(this).css('border', '0');
                    $('#profile-name-msg').css('display', 'none');
                    $('button[name=submit]').removeAttr('disabled');
                }
                
            })
        })
        function correct_profile_name($val)
        {
            console.log(val);
            if (/\s/.test(val)) {
                // It has any kind of whitespace
                $('input[name=profile_name]').css('border', 'red solid thin');
                $('#profile-name-msg').css('display', 'block');
                $('button[name=submit]').attr('disabled', 'true');
                return false;
            }else{
                $('input[name=profile_name]').css('border', '0');
                $('#profile-name-msg').css('display', 'none');
                $('button[name=submit]').removeAttr('disabled');
                return true;
            }
        }
        function submit_form()
        {
            var val = $('input[name=profile_name]').val();
            if(correct_profile_name(val)) {
                return true;
            }else{
                return false;
            }
        }
    </script>
@endsection