<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md shadow bg-white">
        <div class="container">
            <a href="#" class="navbar-brand">Logo..</a>
            <button class="btn navbar-toggler" data-bs-toggle="collapse" data-bs-target="#div">Abc</button>
            <ul class="navbar-nav navbar-collapse" id="div">
                <li class="nav-item"><a href="{{ route('admin')}}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('category') }}" class="nav-link">Category</a></li>
                <!---<li class="nav-item"><a href="#" class="nav-link">Post</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Contact Us</a></li>--->
            </ul>
            <ul class="navbar-nav navbar-collapse float-right" id="div">
                <li class="nav-item ms-md-auto"><a href="{{ route('home') }}" class="nav-link">View</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-md-8">
                @yield('content')
            </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="searchBox p-3 rounded red shadow">
                            <form action="">
                                <strong>Search : </strong><div class="input-group">
                                <input type="search" name="search" value="@if(!empty($searchValue)){{$searchValue}}@endif" class="form-control" placeholder="Search.....">
                                <button class="btn bg-info text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <footer class="bg-black p-2">
        <p class="text-center m-0 text-white">AdminKaran Singh</p>
    </footer>
</body>
</html>