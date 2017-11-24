@extends('web.head')

@section('title')
    所有问题列表
@endsection


@section('content')
    <div class="container">
        <div class="form-group" style="max-width: 700px;width: 100%;">
            @component('web.component.questionList',['questionList'=>$questions])@endcomponent
        </div>
    </div>
@endsection