@extends('web.head')

@section('title')
    所有问题列表
@endsection


@section('content')
    <div class="container">
        <div class="form-group" style="max-width: 700px;width: 100%;">
            <div style="margin-top: 20px;margin-bottom: 20px">
                <a href="{{config('custom.root_url')}}/question/list/updated_at"><button type="button" class="btn btn-secondary">更新时间优先</button></a>
                <a href="{{config('custom.root_url')}}/question/list/same_ask"><button type="button" class="btn btn-secondary">同问人数优先</button></a>
            </div>
            @component('web.component.questionList',['questionList'=>$questions])@endcomponent
        </div>
    </div>
@endsection