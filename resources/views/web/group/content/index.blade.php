@extends('web.head')

@section('title')
    {{ $group->name }}
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{config('custom.root_url')}}/../css/user_center.css">

    <div class="container">
        <div class="left">
            {{--{{$articles}}--}}
            @component('web.group.content.head',['group'=>$group,'is_in'=>$is_in])@endcomponent
            @component('web.group.content.navs',['id'=>$group->id])@endcomponent
            @component('web.component.'.$type.'List',[$type.'List'=>$types])@endcomponent
        </div>
    </div>
@endsection