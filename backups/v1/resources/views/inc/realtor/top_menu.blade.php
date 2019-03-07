<div class="container no-padding cont_sm">  
    <nav class="navbar no-margin no-padding nav1" role="navigation">
        <div class="container menu no-padding">
                
                <div class="navbar-header navbar-default">
                    
                    <p class="visible-xs col-xs-4">Menu <i class="fa fa-angle-double-right"></i> </p>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    
                    </button>
                </div>

                <div id="menu" class="collapse navbar-collapse no-padding list">    
                    <ul class="nav navbar-nav" id="settings">
                        <li><a href="{{url('realtor/home')}}"> <span class="fa fa-home"></span> Home</a></li>
                        <li>
                            <a href="{{url('realtor/messages')}}"> <span class="fa fa-envelope"></span> Messages <span class="label label-success">{{Auth::user()->unread_messages}}</span></a>
                        </li>
                        <li>
                            <a href="{{url('realtor/mycircle')}}"><span class="fa fa-bullseye"></span> My Circles</a>
                        </li>
                        <li>
                            <a href="{{url('realtor/requests')}}"> <span class="fa fa-question-circle"></span> Requests <span class="label label-default">{{$requests}}</span></a>
                        </li>
                        <!--
                        <li>
                            <a href="index.php?page=followers"> <span class="fa fa-user-circle-o"></span> Followers <span class="label label-info"><?php //echo count($followers); ?></span></a>
                        </li>
                        -->
                        <li>
                            <a href="{{url('realtor/tickets')}}"> <span class="fa fa-ticket"></span> Support Tickets</a>
                        </li>
                        <li class="pull-right">
                            <a href="{{url('realtor/logout')}}"><span class="he fa fa-sign-out"></span> Logout</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>
</div> 