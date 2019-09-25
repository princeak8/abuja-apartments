@extends('layouts.realtor')

@section('content')

<style type="text/css">
.messages {
	display: none;
}
</style>

<div class="extra_pages">
	<h4 class="extra_pages__title">
		New Ticket
	</h4>
	<div class="extra_pages__body">
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                <span style="color: red">Fields marked with Asterics are Required</span>

                <p>@include('inc.errors')</p>
		
                @if(request()->session()->exists('msg'))
                    <p class="alert alert-danger py-1">{{session('msg')}} </p>
                @endif
                {!! Form::open(['action' => ['Realtor\TicketController@save'], 'method'=>'POST',  'enctype'=>"multipart/form-data"]) !!}

                    <div class="form-group">
                        <label for="title"><b class="burgundy">* </b><span class="brand-color-darker">Title</span></label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
                            <input id="title" type="text" name="title" class="form-control form-control-sm" required placeholder="Title or Subject" value="{!! old('title') !!}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description"><b class="burgundy">* </b><span class="brand-color-darker">Description of Trouble</span></label>
                        <div class="input-group">
                            <textarea id="description" type="text" name="description" class="form-control form-control-sm" required placeholder="Enter Decription of Trouble" value="{!! old('description') !!}">
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title"><span class="brand-color-darker">Photo of Trouble</span></label>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
                            <input id="image" type="file" name="image" class="form-control form-control-sm" />
                        </div>
                    </div>

                    <div>
                        <input type="submit" name="submit" value="SUBMIT" class="form-control btn-primary" />
                    </div>
                {!! Form::close() !!}

            </div>
			{{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div> --}}
		</div>
	</div>
	

</div>

@endsection
   
@section('js')
	
@endsection