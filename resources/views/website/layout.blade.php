<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'laravel Project')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md shadow bg-white">
        <div class="container">
            <a href="{{route('home')}}" class="navbar-brand">Logo..</a>
            <button class="btn navbar-toggler" data-bs-toggle="collapse" data-bs-target="#div"><i class="fa-solid fa-bars"></i></button>
            <ul class="navbar-nav navbar-collapse" id="div">
                <li class="nav-item"><a href="{{ route('home')}}" class="nav-link">Home</a></li>
                <!---<li class="nav-item"><a href="{{ route('post')}}" class="nav-link">Post</a></li>-->
                <li class="nav-item d-down"><a class="nav-link link">Category</a>
                    <ul class="drop-down rounded" id="">
                    @foreach($category as $category)
                        <li class="nav-item"><a href="{{route('web-category', $category->category)}}" class="nav-link">{{$category->category}}</a></li>
                    @endforeach
                    </ul>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>
            </ul>
            <ul class="navbar-nav navbar-collapse float-right" id="div">
                <li class="nav-item  ms-md-auto"><a href="#" class="nav-link">Contact Us</a></li>
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
                            <form action="{{route('home')}}">
                                <strong>Search : </strong><div class="input-group">
                                <input type="search" name="search" value="@if(!empty($searchValue)){{$searchValue}}@endif" class="form-control" placeholder="Search.....">
                                <button class="btn bg-info text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                                <button class="btn bg-danger text-white"><i class="fa-solid fa-rotate-right"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="searchBox p-3 rounded red mt-2 ">
                            <div class="sidebarHeading mb-2"><strong>Resent Posts</strong></div>
                            @foreach($resentPost as $resentPost)
                            <div class="row">
                                <div class="col-6">
                                    <div class="">
                                        <a href="{{route('post', $resentPost->title)}}"><img class="" src="{{asset('image/'.$resentPost->image)}}" alt="" width="100%" height="100"></a>
                                    </div>
                                </div>

                                <div class="col-6 sideHeading">
                                    <a href="{{route('post', $resentPost->title)}}">{{ substr(strip_tags($resentPost->peragraph), 0, 130) }}</a>
                                </div>
                            </div>
                            <hr size="5">
                            @endforeach
                        </div>
                        <div class="searchBox p-3 rounded red mt-2 viralPost">
                            <div class="sidebarHeading mb-2"><strong>Viral Posts</strong></div>
                            @foreach($viralPost as $viralPost)
                            <div class="row">
                                <div class="col-6">
                                    <div class="">
                                        <a href="{{route('post', $viralPost->title)}}"><img class="" src="{{asset('image/'.$viralPost->image)}}" alt="" width="100%" height="100"></a>
                                    </div>
                                </div>

                                <div class="col-6 sideHeading">
                                    <a href="{{route('post', $viralPost->title)}}">{{ substr(($viralPost->peragraph), 0, 130) }}</a>
                                </div>
                            </div>
                            <hr size="5">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class=" border mb-2 mt-2 rounded p-2">
                    <div class="row">
                    @foreach($otherPost as $otherPost)
                        <div class="col-6 mt-2">
                            <div class="row">
                                <div class="col-9 otherPost">
                                    <h2><a href="{{route('post', $otherPost->title)}}">{{$otherPost->title}}</a></h2>
                                    <p>{{ substr(($otherPost->peragraph), 0, 180) }}</p>
                                </div>
                                <div class="col-3 ps-0">
                                    <div class="">
                                        <a href="{{route('post', $otherPost->title)}}"><img class="rounded shadow" src="{{asset('image/'.$otherPost->image)}}" alt="" width="100%" height="100"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <hr class="otherPostHr">
                    </div>
                </div>
            </div>    
        </div>
    </div>
    
    <a href="#"><div class="a to-top" style="display:none;" id="div" title="To Top"><i class="fa-solid fa-jet-fighter-up"></i></div></a>

    <footer class="bg-black p-2">
        <p class="text-center m-0 text-white">copyrightKaranSingh</p>
    </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('.a').fadeIn();
        } else {
            $('.a').fadeOut();
        }
    });

    $(document).ready(function(){
        $('.a').click(function(){
            $("body").scrollTop(0);
        });
    });
</script>
</html>