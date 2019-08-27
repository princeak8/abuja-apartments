{{-- @include('inc.realtor.company_head_links') --}}

@extends('layouts.realtor')

@section('content')

<div id="main-content" class="content__right__main px-2">
    

    <div class="content__right__main__estate border-radius-big shadow px-4 py-2" >
            
            <div class="content__right__main__estate__title py-2">
                @if(isset($_SERVER['HTTP_REFERER'])) 
                    <h4 class="">
                        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fa fa-caret-left"></i> Back</a>
                    </h4> 
                @endif

                <h3 class="">Edit {{$estate->name}}</h3>
            </div>

        <div class="">
            <p>@include('inc.errors')</p>
        
                @if(request()->session()->exists('estate_msg'))
                    <p class="@if(session('success')==1)alert alert-success @else alert-danger @endif">
                        {{session('estate_msg')}} 
                    </p>
                @endif

                {!! Form::model($estate, ['action' => ['Realtor\EstateController@update'], 'method'=>'PATCH']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name', ['class'=>'brand-color-darker']) !!}
                        <p style="color: red; display: none;" id="name-error"></p>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-thumb-tack"></i></span>
                            {!! Form::text('name', null, ['placeholder'=>'NAME', 'id'=>'name', 'class'=>'form-control input-sm', 'data-id'=>Auth::user()->id, 'required']) !!}
                        </div>  
                    </div>

                    <div class="form-group">  
                        {!! Form::label('location', 'Location', ['class'=>'brand-color-darker']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-map-marker-alt"></i></div>
                            </div>
                            <select id="location" name="location_id" class="form-control input-sm">
                                <option value="">Select a location{{$estate->location_id}}</option>
                                @foreach($locations as $location)
                                    <option @if($location->id == $estate->location_id) selected @endif value="{{$location->id}}"> 
                                        {{$location->name}} ({{$location->id}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">  
                        {!! Form::label('water_source', '* Water Source:', ['class'=>'brand-color-darker']) !!}

                        <span>Water Board</span> 
                        <input id="water_source" type="radio" name="water_source" value="Water Board" required
                        @if(old('water_source')=='Water Board') checked @endif/>  
                        
                        <span>Bore Hole</span> 
                        <input id="water_source" type="radio" name="water_source" value="Bore Hole" required
                        @if(old('water_source')=='Bore Hole') checked @endif/> 
                        
                        <span>Well</span> 
                        <input id="water_source" type="radio" name="water_source" value="Well" required
                        @if(old('water_source')=='Well') checked @endif/>
                            
                        <span>N/A</span> 
                        <input id="water_source" type="radio" name="water_source" value="N/A" required
                        @if(!old('water_source') || old('water_source')=='N/A') checked @endif/>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('facilities', 'Additional Estate Facilities:') !!}
                        {!! Form::text('facilities', old('facilities'), ['id'=>'facilities', 'class'=>'form-control input-sm', 'placeholder'=>'Enter each facility separated with a comma. e.g; shower, sitouts, tiles']) !!}
                    </div> 
                    
                    <div class="form-group">
                        {!! Form::label('description', 'Description:', ['class'=>'brand-color-darker']) !!}
                        {!! Form::textarea('description', null, ['placeholder'=>'Description', 'class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">  
                        <input class="form-control btn btn-primary rounded-corner" type="submit" name="submit" value="Update" />
                    </div>
                    <input type="hidden" name="estate_id" value="{{$estate->id}}" />
                    {!! Form::close() !!}
        </div>

    </div>
    
    
</div>


@endsection