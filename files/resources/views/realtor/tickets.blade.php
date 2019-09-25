@extends('layouts.realtor')

@section('content')

<style type="text/css">
.green {
	color: green;
}
.red {
    color: red;
}
</style>

<div class="extra_pages">
	<h4 class="extra_pages__title">
		<span class="fa fa-envelope"></span> My Tickets<a class="btn btn-primary" href="{{url('realtor/create_ticket')}}">+</a>
	</h4>
	<div class="extra_pages__body">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-home" aria-selected="true">ALL</a>
				{{-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
				<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> --}}
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                @if(request()->session()->exists('msg'))
                    <p class="alert alert-success py-1">{{session('msg')}} </p>
                @endif

                @if($tickets->count() == 0)
                    <p class="mt-4">
                        You do not have any tickets.. <br/><br/>
                        
                        <b>Please Click <a href="{{url('realtor/create_ticket')}}">HERE</a> to create a ticket</b>
                    </p>
                @else
                    <table class="table table-responsive col-md-10 offset-md-1">
                        <thead>
                            <th>S/N</th>
                            <th class="text-center">TITLE</th>
                            <th>TICKET CREATED ON</th>
                            <th>STATUS</th>
                        </thead>
                        <tbody>
                            <?php $n=0; ?>
                            @foreach($tickets as $ticket)
                            <?php $n++; ?>
                                <tr>
                                    <td>{{$n}}</td>
                                    <td>{{$ticket->title}}</td>
                                    <td class="text-center">{{$ticket->created}}</td>
                                    <td class="text-center @if($ticket->status=='PENDING') red @else green @endif">{{$ticket->status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
			</div>
			{{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div> --}}
		</div>
	</div>
	

</div>

@endsection
   
@section('js')
	
@endsection