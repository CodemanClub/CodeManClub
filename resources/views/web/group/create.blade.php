@extends('web.head')
@section('title')
创建小组
@endsection
@section('content')
    <div class="container">
        <link rel="stylesheet" href="{{config('custom.root_url')}}/../css/form.css">


        <div class="form-center">
            <form method="post" action="{{config('custom.root_url')}}/group/create">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">名称</label>
                    <input name="name" type="" class="form-control" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="intro">简介</label>
                    <textarea name="intro" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="form-control btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection