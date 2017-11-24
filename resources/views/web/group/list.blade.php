@extends('web.head')
@section('content')
    <div style="height: 20px"></div>
    <div class="container">
        <div style="max-width: 700px;width: 100%;">
            @component('web.component.groupList',['groupList'=>$groups])@endcomponent
        </div>
    </div>
@endsection