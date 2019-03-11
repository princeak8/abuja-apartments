<div class="col-lg-3 left_details">
    <div class="profile">
        <div class="profile__heading">
    	   <h5 class="profile__heading__title">Realtor Details <span class="fa fa-angle-down hi"></span>
                {{-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#view_hs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> --}}
           </h5>
        </div>

        <div id="view_hs" class="profile__body">
            
            @foreach($house->realtors as $realtorHouse)
                <div class="row">
                    <div class="col-4 pr-0">
                        <div class="profile__body__img">
                            <img src="{{ asset('images/profile_pic2.png') }}" class="" style="width: 100%; height: 100%;" />
                        </div>
                    </div>
                    <div class="col-8 pl-1 py-2 profile__body__heading">
                        @php $realtor_type = $realtorHouse->realtor->type @endphp
                        <p class="m-0 profile__body__heading__title">
                            {{$realtor_type =='company' ? 
                                $realtorHouse->realtor->biz_name : 
                                $realtorHouse->realtor->full_name}}
                        </p>
                        
                        @if($realtor_type=='company')
                            <p class="m-0 profile__body__heading__subtitle">Real Estate Firm </p>
                            <p class="m-0 profile__body__heading__verification">
                                @if($realtorHouse->realtor->verified==0) 
                                    <span class="not_verify"><i class="fa fa-times"></i> Not Verified </span>
                                @else
                                    <span class="verify"><i class="fa fa-check"></i> Verified</span>
                                @endif
                                <a href="{{url($realtorHouse->realtor->profile_name)}}" >
                                    View Portfolio <i class="fa fa-angle-double-right"></i> 
                                </a>
                            </p>  
                        @else
                            <p class="m-0 profile__body__heading__subtitle">Agent</p>
                            <p class="m-0 profile__body__heading__verification">
                                @if($realtorHouse->realtor->verified==0)
                                    <span class="not_verify"><i class="fa fa-times"></i>  Not Verified </span>
                                @else
                                    <span class="verify"><i class="fa fa-check"></i> Verified</span>
                                @endif
                                <a href="{{url($realtorHouse->realtor->profile_name)}}" >
                                    View Portfolio <i class="fa fa-angle-double-right"></i> 
                                </a>
                            </p>
                        @endif
                        
                    </div>
                </div>
                
	            <div class="row">
	            	<div class="col-12 profile__body__contact">
                        <hr class="m-0 mb-1">
                        <p class="m-0"><i class="fa fa-envelope"></i>{{$realtorHouse->realtor->email}}</p>
                        <p class="m-0"><i class="fa fa-phone"></i>
                            <?php $i = 0; ?>
                            @foreach($realtorHouse->realtor->phones as $phone)
                                <?php $i++; ?>
                                {{$phone->phone}}
                                @if($i < $realtorHouse->realtor->phones->count())
                                    ,
                                @endif
                            @endforeach
                        </p>
                        
                        @if($realtorHouse->realtor->parent_id>0) 
                            <b>Company: </b><span>{{App\Realtor::getRealtor($realtorHouse->realtor->parent_id)->biz_name}}</span><br/>
                        @endif
                    </div>
	            </div>
	            

	            <div class="mes_fol no-margin">
                <p class="no-margin">
                
                    @if(Auth::user() && Auth::user()->id != $realtorHouse->realtor->id)
                    	<div id="msg-sent-success" style="color: green; display: none;"><b>Message sent successfully</b></div>
	                    <a href="javascript:void(0)" onClick="messageClass.form({{$realtorHouse->realtor->id}}, {{Auth::user()->id}})" id="sender{{Auth::user()->id}}">
	                    	<span class="fa fa-envelope"></span> 
	                        Send Message to Realtor <span class="fa fa-caret-down"></span> 
	                    </a>
                    @endif
                    
                    <br/>
                  	
                    <div class="clear"></div>
                    
                    <div class="message_form" id="form{{$realtorHouse->realtor->id}}" style="display:none">
                    	<a href="javascript:void(0)" onClick="messageClass.hide()">Close Form</a>
                        <!--<input type="submit" class="form-control" value="SEND" onClick="messageClass.send()" />-->
                        <div class="form-content"></div>
                    </div>
                </p>   

                @if(Auth::user())
                    
                    @if(Auth::user()->type != 'company' && Auth::user()->id != $realtorHouse->realtor->id)  
                        @if(Auth::user() && !$realtorHouse->realtor->is_follower(Auth::user()->id)) 
                            {!! Form::open(['url' => 'follow', 'method'=>'post', 'style'=>'display:inline-block;']) !!}
                                <input type="hidden" name="followed" value="{{$realtorHouse->realtor->id}}" />
                                <input type="hidden" name="follower" value="{{Auth::user()->id}}" />
                                <button class="btn btn-info" type="submit" name="submit" value="Follow This Realtor" onclick="return confirm('Are you sure that you want to follow this realtor?')"><span class="fa fa-user-plus"></span> Follow This Realtor</button>
                                <!--<input type="submit" name="submit" value="Follow This Realtor" />-->
                            {!! Form::close() !!}
                        @endif 
                    	@if($realtorHouse->realtor->is_follower(Auth::user()->id))
	                    	<span class="ffg">You are following this realtor</span>
	                        {!! Form::open(['url' => 'unfollow', 'method'=>'post', 'name'=>'unfollow', 'style'=>'display:block;']) !!}
	                            <input type="hidden" name="follow_id" value="{{App\Follower::getFollow($realtorHouse->realtor->id, Auth::user()->id)->id}}" />
	                            <button class="btn btn-danger" id="unfollow" type="submit" name="submit" value="Unfollow" onclick="return confirm('Are you sure that you want to unfollow this realtor?')" ><span class="fa fa-user"></span><span class="fa fa-minus"></span> Unfollow</button>
	                            <!--<input class="btn-danger" id="unfollow" type="submit" name="submit" value="Unfollow" />-->
	                       	</form>
	                       	<div class="clear"></div>
                		@endif
                	@endif
                @endif
                <div class="clear"></div>
            </div>
            @endforeach

        </div><!-- End of the panel_body -->
        <div class="clear"></div>
    </div>
</div>