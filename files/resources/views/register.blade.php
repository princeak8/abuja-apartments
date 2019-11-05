@extends('layouts.public')


@section('content') 
    <div class="row container-fluid bg_white login_page" style="margin-top: 100px;">
        <div class="row panel panel-default col-md-12">
            <div class="panel-heading">
                @if($type=='individual')
                    <h4 class="panel-title"><span class="fa fa-edit"></span> REGISTRATION PAGE</h4>
                @else
                    <h4 class="panel-title"><span class="fa fa-edit"></span> COMPANY REGISTRATION PAGE</h4>
                @endif
            </div>
            <div class="row panel-body col-md-10 offset-md-1">
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
                    {!! Form::open(['action' => ['Realtor\RegisterController@register'], 'method'=>'POST', 'autocomplete'=>'off', 'class'=>'row col-md-12']) !!}
                @endif
                    <input autocomplete="off" type="text" style="display:none" />
                    <input type="text" style="display:none">
                    <input type="password" style="display:none">

                    <div class="col-md-4">
                    <b class="red">* </b><label for="firstname">@if($type=='individual') First @else Company @endif Name:</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">fn</span>
                                <input id="firstname" class="form-control input-sm" type="text" name="firstname" placeholder="FIRST NAME" required value="{!! old('firstname') !!}" />
                            </div>
                    </div>

                    <div class="col-md-4">
                            Profilename
                    </div>
                </form>
            </div>
        </div>
            
    </div>

@endsection