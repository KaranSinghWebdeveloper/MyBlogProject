@extends('website/layout')
@section('title')
{{ !empty($search[0]) ? $search[0]['title'] : 'Home Page' }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="border p-3 rounded">
            @if($search)
            @foreach($search as $search)
            <h1 class="orange"><a href="{{route('post', $search->title)}}">{{$search->title}}</a></h1>
            <div class="row">
                <div class="col-6">
                    <div class="">
                        <a href="{{route('post', $search->title)}}"><img class="" src="{{asset('image/'.$search->image)}}" alt="" width="100%" height="200"></a>
                    </div>
                </div>
                <div class="col-6">
                {{ substr(strip_tags($search->peragraph), 0, 300) }}
                    <!--<div><strong class="">Data:06/12/2023</strong></div>-->
                    <div>
                        <a href="{{route('web-category', $search->category)}}"><span class="badge category">{{$search->category}}</span></a>
                        <a href="{{route('post', $search->title)}}"><span class="float-end badge bg-success">Read More</span></a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            @if(!empty($find))
                <div class="border text-center find mb-2 mt-2">
                    Not Find Please
                    Search New Value🙃
                </div>
            @endif
            @foreach($data as $data)
            <h1 class="orange"><a href="{{route('post', $data->title)}}">{{$data->title}}</a></h1>
            <div class="row">
                <div class="col-6">
                    <div class="">
                        <a href="{{route('post', $data->title)}}"><img class="" src="{{asset('image/'.$data->image)}}" alt="" width="100%" height="200"></a>
                    </div>
                </div>
                <div class="col-6">
                {{ substr(strip_tags($data->peragraph), 0, 300) }}
                    <!--<div><strong class="">Data:06/12/2023</strong></div>-->
                    <div>
                        <a href="{{route('web-category', $data->category)}}"><span class="badge category">{{$data->category}}</span></a>
                        <a href="{{route('post', $data->title)}}"><span class="float-end badge bg-success">Read More</span></a>
                    </div>
                </div>
            </div>
            <hr size="10">
            @endforeach
        </div>
    </div>
</div>


@endsection