@extends('web.head')

@section('title')
    提问题
@endsection

@section('content')
    <div class="container">

        <link rel="stylesheet" href="{{config('custom.root_url')}}/../editor/css/editormd.min.css">
        <script src="{{config('custom.root_url')}}/../editor/editormd.min.js"></script>

        <form method="post" action="{{config('custom.root_url')}}/question/ask">
            {{ csrf_field() }}
            <div class="form-group" style="float: right">
                <input type="submit" class="btn btn-primary">
            </div>
            <div class="form-group">
                <input name="title" type="text" class="form-control" placeholder="标题">
                @if ($errors->first('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
                {{-- 选择小组，默认是公开的 --}}
                <div style="height: 20px"></div>
                <select name="group_id" class="custom-select form-group">
                    <option selected value="0">建议您为您的问题选择一个小组，方便更多志同道合的code man发现</option>
                    @foreach($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <div id="editormd">
                    <textarea  name="content">请在这里描述问题,文档编辑器采用markdown语法。问题区域不会自动保存，编辑完成请及时提交</textarea>
                </div>
                @if ($errors->first('content'))
                    <span class="help-block">{{ $errors->first('content') }}</span>
                @endif
            </div>
            <input id="articleId" name="id" type="text" hidden>
        </form>
        <script>
            $(function() {
                var editor = editormd("editormd", {
                    path : "{{config('custom.root_url')}}/../editor/lib/",// Autoload modules mode, codemirror, marked... dependents libs path
                    emoji : true,
                    height: 500,
                });

            });
        </script>
    </div>
@endsection