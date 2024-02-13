@extends('backend/AdminLayout')
@section('title')
    {{ !empty($search[0]) ? $search[0]['title'] : 'Admin Page' }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="border p-3 rounded">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            Data Store Successfully.
        </div>
        @endif
        @if(session('delete'))
        <div class="alert alert-success" role="alert">
            Data Delete Successfully.
        </div>
        @endif
        @if(session('notDelete'))
        <div class="alert alert-danger" role="alert">
            Data Not Delete.
        </div>
        @endif
        @if(session('updatenow'))
        <div class="alert alert-success" role="alert">
            Data Update Successfully.
        </div>
        @endif
            <h1 class="text-center">@if(!empty($update)) Update Post @else Add Post @endif</h1>
            @if(!empty($update))
            @foreach($update as $update)
            <form action="{{ route('updateNow', $update->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf
            Category : 
            <select class="form-control" name="category_id">
                <option value="{{$update->category_id}}">{{$update->category}}</option>
            @foreach($category as $category)
                <option value="{{$category->id}}">{{$category->category}}</option>
            @endforeach
            </select>
            <span class="text-danger"> 
                @error('category')
                    {{ $message }}
                @enderror</span>
            Title : 
            <input type="text" class="form-control" name="title" value="{{$update->title}}">
            <div><span class="text-danger"> 
                @error('title')
                    {{ $message }}
                @enderror</span></div>
                <div class="m-2 text-center">
                    <img src="{{asset('image/'.$update->image)}}" alt="" height="50">
                </div>
            image : 
            <input type="file" class="form-control" name="image" value="{{$update->image}}">
            <div><span class="text-danger"> 
                @error('image')
                    {{ $message }}
                @enderror</span></div>
            Peragraph : 
            <textarea  id="editor" class="form-control"  name="peragraph">{{$update->peragraph}}</textarea>
            <div><span class="text-danger"> 
                @error('peragraph')
                    {{ $message }}
                @enderror</span></div>
            <button class="btn bg-primary mt-2 text-white">Submit</button>
            </form>
            @endforeach

            @else

            <form action="{{ route('data') }}" method="POST" enctype="multipart/form-data">
                @csrf
            Category : 
            <select class="form-control" name="category_id" placeholder="Category" required>
                <option value="" disabled selected hidden>Choose a Category</option>
            @foreach($category as $category)
                <option value="{{$category->id}}">{{$category->category}}</option>
            @endforeach
            </select>
            <span class="text-danger"> 
                @error('category')
                    {{ $message }}
                @enderror</span>
            Title : 
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            <div><span class="text-danger"> 
                @error('title')
                    {{ $message }}
                @enderror</span></div>
            image : 
            <input type="file" class="form-control" name="image">
            <div><span class="text-danger"> 
                @error('image')
                    {{ $message }}
                @enderror</span></div>
            Peragraph : 
            <textarea  id="editor" class="form-control"  name="peragraph">{{ old('peragraph') }}</textarea>
            <div><span class="text-danger"> 
                @error('peragraph')
                    {{ $message }}
                @enderror</span></div>
            <button class="btn bg-primary mt-2 text-white">Submit</button>
            </form>
            @endif
        </div>
    </div>

    <div class="col-md-12 mt-2">
        <table class="table table-striped">
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Category</th>
                <th>image</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            @if($search)
            @foreach($search as $search)
            <tr>
                <td>{{$search->id}}</td>
                <td>{{$search->title}}</td>
                <td>{{$search->category}}</td>
                <td><img src="{{asset('image/'.$search->image)}}" alt="" height="50"></td>
                <td><a href="{{route('updatePost', $search->id)}}" class="badge bg-siccess text-decoration-none">Update</a></td>
                <td><a href="{{route('deletePost', $search->id)}}" class="badge bg-danger text-decoration-none">Delete</a></td>
            </tr>
            @endforeach
            @endif
            @if(!empty($find))
            <div class="border text-center find mb-2 mt-2">
                Not Find Please
                 Search New Value🙃
            </div>
            @endif
            @foreach($data as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{{$data->category}}</td>
                <td><img src="{{asset('image/'.$data->image)}}" alt="" height="50"></td>
                <td><a href="{{route('updatePost', $data->id)}}" class="badge bg-success text-decoration-none">Update</a></td>
                <td><a href="{{route('deletePost', $data->id)}}" class="badge bg-danger text-decoration-none">Delete</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endsection