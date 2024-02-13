@extends('backend/AdminLayout')
@section('title')
    Category Page
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('success'))
        <div class="alert alert-danger" role="alert">
            Delete Category Successfully.
        </div>
        @endif
        <div class="border p-3 rounded">
            <h1 class="text-center">Add Category</h1>
            <form action="{{ route('addcategory') }}" method="POST" enctype="multipart/form-data">
                @csrf
            Category : 
            <input type="text" class="form-control" name="category" value="{{ old('category') }}">
            <div><span class="text-danger"> 
                @error('category')
                    {{ $message }}
                @enderror</span></div>
            <button class="btn bg-primary mt-2 text-white">New Category</button>
            </form>
        </div>
    </div>

    <div class="col-md-12 mt-2">
        <table class="table table-striped text-center">
            <tr>
                <th>id</th>
                <th>Category</th>
                <th>Delete</th>
            </tr>
            @foreach($category as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->category}}</td>
                <td><a href="{{route('delete', $category->id)}}" class="badge bg-danger text-decoration-none">Delete</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection