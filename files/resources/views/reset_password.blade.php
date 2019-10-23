@extends('layouts.public', ['page'=>'Login'])

@section('content')
<style type="text/css">
    [v-cloak] {
        display: none;
    }
</style>


<div id="app" class="container-fluid login">

    <div v-cloak v-if="resetted">
        <h4 class="login__container__title" style="margin-top: 80px;">
            <span><i class="fas fa-signin"></i>RESET PASSWORD</span>
        </h4>
        <p class="alert alert-success">You have changed/Resetted your password successfully</p>
    </div>

    <div v-cloak v-if="expired">
        <h4 class="login__container__title" style="margin-top: 80px;">
            <span><i class="fas fa-signin"></i>RESET PASSWORD</span>
        </h4>
        <p class="alert alert-danger">The Reset Link has expired</p>
        <p>Click <a href="{{url('forgot_password')}}">Here</a> to Get Another Link</p>
    </div>

    <div v-cloak v-if="!linkExists">
        <h4 class="login__container__title" style="margin-top: 80px;">
            <span><i class="fas fa-signin"></i>RESET PASSWORD</span>
        </h4>
        <p class="alert alert-danger">The Reset Link No Longer Exists</p>
        <p>Click <a href="{{url('forgot_password')}}">Here</a> to Get Another Link</p>
    </div>


    <div v-if="!resetted && !expired && linkExists" class="login__container col-lg-5 col-12">   	
        <h4 class="login__container__title">
            <span><i class="fas fa-signin"></i>RESET PASSWORD</span>
        </h4>

        @if(!$reset)
            <p class="alert alert-danger"> RESET LINK NO LONGER EXIST </p>
            <p>Click <a href="{{url('forgot_password')}}">Here</a> to generate another reset link</p>
        @else
            @if($expired)
                <p class="alert alert-danger"> THIS RESET LINK HAS EXPIRED</p>
                <p>Click <a href="{{url('forgot_password')}}">Here</a> to get another reset link</p>
            @else
            
                <div class="login__container__body">
                    @if(request()->session()->exists('msg'))
                        <p @if(session('success')==1) class="alert-success" @else class="alert-danger" @endif>{{session('msg')}} </p>
                    @endif
                    <?php //echo $request->session()->token(); ?>
                    <p>
                        @include('inc.errors')
                    </p>

                    <p v-cloak v-if="errorMsg != ''" class="alert alert-danger">@{{errorMsg}}</p>

                    <form class="login__container__body__form" @submit.prevent="submit">
                        
                        <div class="login__container__body__form__input">
                            <input id="password1" class="form-control form-control-sm" type="password" v-model="password" required @keyup="compare" />
                            <label for="password1">New Password</label>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="login__container__body__form__input">
                            <input id="password2" class="form-control form-control-sm" type="password" v-model="password_confirm" required @keyup="compare" />
                            <label for="password2">Password</label>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif    
                        </div>
                        <div class="">    
                            {{-- <input class="form-control btn btn-info" type="submit" name="submit" value="LOGIN" /> --}}
                            <button type="submit" name="submit" class="btn btn-primary" :disabled="!match && !submitting">Submit</button>
                        </div>
                    </form>
                </div>
            @endif
        @endif
    </div>
        
</div>

@endsection

@section('js')
<script>
    var vm = new Vue({
            el: '#app',
            data: {
                password: '',
                password_confirm: '',
                token: '{{$token}}',
                match: false,
                submitting: false,
                errorMsg: '',
                linkExists: true,
                expired: false,
                resetted: false
            },
            methods: {
                compare: function() {
                    if(this.password != '' && this.password_confirm != '' && this.password==this.password_confirm) {
                        this.match = true;
                        this.errorMsg = '';
                    }else{
                        this.match = false;
                        this.errorMsg = 'Passwords Do not Match';
                    }
                },
                submit: function() {
                    this.errorMsg = '';
                    this.submitting = true;
                    var url = APP_URL+'reset_password';
                    var formData =  {
                        'token' : this.token,
                        'password' : this.password
                    };
                    var self = this;
                    axios.post(url, formData)
                    .then(function (res) {
                        console.log(res.data);
                        var data = res.data.data;
                        self.submitting = false;
                        if(res.data.reset==1) {
                            if(res.data.expired == 0) {
                                if(res.data.success==1) {
                                    self.resetted = true;
                                }else{
                                    self.errorMsg = 'There was an error.. Try again'
                                }
                            }else{
                                self.expired = true;
                            }
                        }else{
                            self.linkExists = false;
                        }
                    })
                    .catch(function(error) {
                        self.submitting = false;
                        console.log('There has been a problem with your operation: ' + error.message);
                        // ADD THIS THROW error
                        throw error;
                        self.errorMsg = 'There has been a problem with the operation.. Please Refresh and try again';
                    });
                }
            }
        });
</script>

@endsection