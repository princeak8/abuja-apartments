@extends('layouts.public', ['page'=>'contact'])

@section('content') 


	<div class="col-md-12" style="min-height: 400px;">
		<h4 style="margin-left: 10%;">{{$page->title}}</h4>
		
			<div class="col-md-12" style="margin-left: 10%; margin-top: 40px;">
			<?php echo $page->content; ?>
		</div>

        <div id="contact-form" class="col-md-6 offset-md-3 mb-2">
            @if(request()->session()->exists('msg'))
				<p class="alert alert-success py-2">{{session('msg')}} </p>
			@endif
            {!! Form::open(['action' => ['PageController@send', $page->name], 'method'=>'POST', 'autocomplete'=>'off']) !!}
                Name:
                <input type="text" class="form-control" name="name" placeholder="Full Name" required />
                Email:
                <input type="email" class="form-control" placeholder="email" name="email" />

                Message:
                <textarea class="form-control" name="message" placeholder="Enter Your Message Here" rows="6"></textarea>

                <input type="submit" class="form-control btn-primary" name="submit" value="Send" />

            </form>
        </div>

	</div>

@endsection

@section('js')

<script type="application/javascript">


</script>

@endsection