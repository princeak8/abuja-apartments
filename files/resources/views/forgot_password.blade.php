@extends('layouts.public', ['page'=>'Password Recovery Secret'])

@section('content')
<div id="app" class="container-fluid login" style="min-height: 450px;">

    <div v-if="mailSent" style="margin-top:80px;">
        <h4 class="login__container__title">
            <span><i class="fas fa-signin"></i> Forgot Password</span>
        </h4>

        <p class="alert alert-success col-md-12" v-cloak>@{{message}} </p>
    </div>

    <div v-if="!mailSent" class="login__container col-lg-5 col-12">   	
        <h4 class="login__container__title">
            <span><i class="fas fa-signin"></i> Forgot Password</span>
        </h4>

        <div class="login__container__body ">
                

            <div style="margin-top:50px;">
                <div v-if="verifiedEmail" v-cloak>
                    <form class="login__container__body__form mt-4" @submit.prevent="submit_sec_ans">
                        <span v-if="errorMsg != ''" class="alert-danger help-block">
                            <strong v-cloak>@{{errorMsg}}</strong>
                        </span>
                        <div class="login__container__body__form__input">
                            <p v-cloak><strong>Security Question:</strong> @{{secQuestion}} ?</p>
                            <input id="sec-ans-input" class="form-control form-control-sm" type="text" v-model="answer" placeholder="Answer" :required="ansRequired" />
                        </div>
                        <div class="">    
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div v-else v-cloak>
                    <form class="login__container__body__form" @submit.prevent="submit_email">
                        <span v-if="errorMsg != ''" class="alert-danger help-block">
                            <strong v-cloak>@{{errorMsg}}</strong>
                        </span>
                        <div class="login__container__body__form__input">
                            
                            <input class="form-control form-control-sm" type="text" v-model="email" required />
                            <label for="email">Enter Your Email</label>
                        </div>
                        <div class="">    
                            <button type="submit" name="submit" class="btn btn-primary" :disabled="submitting">Submit</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
        
</div>

@endsection


@section('js')
<script>
    var vm = new Vue({
            el: '#app',
            data: {
                email: '',
                secQuestion: '',
                secAnswer: '',
                answer: '',
                verifiedEmail: false,
                correctAnswer: false,
                submitting: false,
                errorMsg: '',
                message: '',
                mailSent: false,
                ansRequired: false,
            },
            methods: {
                submit_email: function() {
                    if(this.email != '') {
                        this.errorMsg = '';
                        this.submitting = true;
                        var url = APP_URL+'password_recovery/verify_email';
                        var formData =  {
                                'email' : this.email
                            };
                        var self = this;
                        
                        axios.post(url, formData)
                        .then(function (res) {
                            console.log(res.data);
                            var data = res.data.data;
                            self.submitting = false;
                            if(res.data.tokenExists == 0) {
                                if(res.data.verified==1) {
                                    if(res.data.secQuestion_set == 1) {
                                        self.verifiedEmail = true;
                                        self.secQuestion = res.data.sec_question;
                                        self.secAnswer = res.data.sec_answer
                                        $('#sec-ans-input').attr('required');
                                    }else{
                                        self.mailSent = true;
                                        self.message = "An Email has been sent to the email that you entered with a link to reset your password";
                                    }
                                }else{
                                    self.errorMsg = 'The email You entered was not found in our database.. Please click on the Register button to register'
                                }
                            }else{
                                self.errorMsg = 'There is already a valid reset token set. Go to your email and follow the link there'
                            }
                        })
                        .catch(function(error) {
                            self.submitting = false;
                            console.log('There has been a problem with your operation: ' + error.message);
                                // ADD THIS THROW error
                                throw error;
                                self.errorMsg = 'There has been a problem with the operation.. Please Refresh and try again';
                        });
                    }else{
                        this.errorMsg = 'Please Enter your Email';
                    }
                },
                submit_sec_ans: function() {
                    this.ansRequired = true;
                    this.errorMsg = '';
                    this.submitting = true;
                    if(this.answer != '') {
                        if(this.answer==this.secAnswer) {
                            var url = APP_URL+'password_recovery/send_recovery_mail';
                            var formData =  {
                                    'email' : this.email
                                };
                            var self = this;
                            
                            axios.post(url, formData)
                            .then(function (res) {
                                //console.log(res.data);
                                var data = res.data.data;
                                self.submitting = false;
                                if(res.data.success==1) {
                                    self.mailSent = true;
                                    self.message = "A Mail has been sent to the email that you provided with a link to reset your password.. Check your spam mail if you dont see it in your inbox";
                                }else{
                                    self.errorMsg = 'An Error Occured.. Please try again';
                                }
                            })
                            .catch(function(error) {
                                self.submitting = false;
                                console.log('There has been a problem with your operation: ' + error.message);
                                    // ADD THIS THROW error
                                    throw error;
                                    self.errorMsg = 'There has been a problem with the operation.. Please Refresh and try again';
                            });
                        }else{
                            this.errorMsg = 'The answer you entered is incorrect';
                        }
                    }else{
                        this.errorMsg = 'Please Enter An Answer';
                    }
                },
            }
        });
</script>

@endsection