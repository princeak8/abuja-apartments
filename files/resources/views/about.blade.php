@extends('layouts.public', ['page'=>'about'])

@section('content') 


	<div class="col-md-12" style="min-height: 400px;">
		<h4 style="margin-left: 10%;">{{$page->title}}</h4>
		
			<div class="col-md-12" style="margin-left: 10%; margin-top: 40px;">
			<?php echo $page->content; ?>
		</div>

	</div>

@endsection

@section('js')

<script type="application/javascript">


</script>

@endsection