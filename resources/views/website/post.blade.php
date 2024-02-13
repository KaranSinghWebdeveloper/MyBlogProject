@extends('website/layout')
@section('title')
{{ !empty($data[0]['title']) ? $data[0]['title'] : 'Post Page' }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="border p-3 rounded">
            @foreach($data as $data)
            <h1 class="orange">{{$data->title}}</h1>
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <img class="" src="{{asset('image/'.$data->image)}}" alt="" width="100%" height="400">
                    </div>
                </div>
                <div class="col-12">
                {{$data->peragraph}}
                </div>
                <div>
                    <a href="{{route('web-category', $data->category)}}" class="text-black"><span class="badge bg-success">{{$data->category}}</span></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection