@extends('layouts.email')

@section('content')

    <div id="content" class="mt-3">
        <p>
            Dear Akachukwu Aneke
        </p>
        <p>
            {{$msg}}
        </p>
    </div>
@endsection