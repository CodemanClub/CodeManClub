<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="code,codeman,codemanclub,程序员俱乐部" />
    <meta name="description" content="程序员俱乐部，提供程序员文章，问答，科技信息资讯" />
    <title>@yield('title')-CodeMan</title>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fcfaf2">
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{config('custom.root_url')}}/">CodeMan</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{config('custom.root_url')}}/">文 章 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{config('custom.root_url')}}/question/list">问 题</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{config('custom.root_url')}}/group/list">小 组</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{config('custom.root_url')}}/article/post">写文章</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{config('custom.root_url')}}/question/ask">提问题</a>
                </li>
                
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <div style="width: 10px"></div>
            <ul class="navbar-nav">
                @if(Auth::user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{config('custom.root_url')}}/group/create">创建小组</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{config('custom.root_url')}}/user/center/{{Auth::id()}}/article">个人中心</a>
                            <a class="dropdown-item" href="{{config('custom.root_url')}}/user/logout">退出登录</a>
                        </div>
                    </li>
                 @else
                    <li class="btn btn-secondary"><a href="{{config('custom.root_url')}}/user/login" style="color: black">登陆</a></li>
                    <div style="width: 10px"></div>
                    <li class="btn btn-secondary"><a href="{{config('custom.root_url')}}/user/regist" style="color: black">注册</a></li>
                @endif
            </ul>
        </div>
    </nav>
    @yield('content')
</div>
</body>
</html>
