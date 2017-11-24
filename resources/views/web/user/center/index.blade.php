{{--@component('web.head',['title'=>$user->name])@endcomponent--}}
@extends('web.head')

@section('title',$user->name)

@section('content')
<link rel="stylesheet" type="text/css" href="{{config('custom.root_url')}}/../css/user_center.css">

<div class="container">
	<div class="left">
		@component('web.user.center.head',['user'=>$user])@endcomponent
    	@component('web.user.center.navs',['user'=>$user])@endcomponent
        @component('web.component.'.$type.'List',[$type.'List'=>$types])@endcomponent
    </div>
</div>
@endsection