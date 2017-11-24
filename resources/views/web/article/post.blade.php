@extends('web.head')

@section('title')
    写文章
@endsection

@section('content')
<div class="container">

    <link rel="stylesheet" href="{{config('custom.root_url')}}/../editor/css/editormd.min.css">
    <script src="{{config('custom.root_url')}}/../editor/editormd.min.js"></script>

    <form method="post" action="{{config('custom.root_url')}}/article/post">
        {{ csrf_field() }}
        <div class="form-group" style="float: right">
            <input type="submit" class="btn btn-primary">
        </div>
        <div class="form-group">
            <input name="title" type="text" class="form-control" placeholder="输入标题">
            @if ($errors->first('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
            {{-- 选择小组，默认是公开的 --}}
            <div style="height: 20px"></div>
            <select name="group_id" class="custom-select form-group">
              <option selected value="0">若您不选择，文章将不会在任何小组下展示</option>
              @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
              @endforeach
            </select>
        </div>

        <div class="form-group">
            <div id="editormd">
                <textarea  name="content">文档采用markdown语法，您写的文章将会自动保存下来，除非您点击发布，但不会发布，您可以在我的文章列表内获取</textarea>
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
                // theme : "dark",
                // Preview container theme, added v1.5.0
                // You can also custom css class .editormd-preview-theme-xxxx
                // editorTheme: "blackboard",
                // previewTheme : "dark",
                // Added @v1.5.0 & after version this is CodeMirror (editor area) theme
//                editorTheme : editormd.editorThemes['dark']
            });

        });
    </script>
    <script>
        function autosave(){
            var title_val = $(" input[ name='title' ] ").val()
            var content_val = $(" textarea[ name='content'] ").val()

            if ($(" input[ name='id'] ").val())	//如果有值，则说明用户在更新文章
                var article_id = $(" input[ name='id'] ").val()
            if (title_val&&content_val)
                $.ajax({
                    url:"{{config('custom.root_url')}}/article/autosave",
                    data: { title: title_val,content:content_val,id:article_id },
                    method:'post',
                    success:function(result){
                        if (result.articleid!=undefined)
                            document.getElementById('articleId').value = result.articleid
                    }
                });
        }
        $(document).ready(function(){
            setInterval("autosave()",3000);
        });
    </script>
</div>
@endsection