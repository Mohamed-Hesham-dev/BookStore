
@extends('master')
@section('content')

<div class="container" style="opacity: 0.9 ;clear: both">
    <div class="row">
        @foreach($section as $section)
            <div class="col-md-3">
                <div class="thumbnail"  style="padding: 40px ;float: left">
                    <img src="image/{{$section->image_name}}" width="250px" height="250px" >
                    <h3 style="color: white"><a class="btn btn-primary">{{$section->section_name}}</a> </h3>
                </div>

            </div>
        @endforeach

    </div>



</div>


@stop

