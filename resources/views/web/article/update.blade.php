@extends('web.head')
@section('content')
<div class="container">
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?0326d73869f0e1c42057054038f66fc9";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <link rel="stylesheet" href="{{config('custom.root_url')}}/../editor/css/editormd.min.css">
    <script src="{{config('custom.root_url')}}/../editor/editormd.min.js"></script>

    <form method="post" action="{{config('custom.root_url')}}/article/update">
        {{ csrf_field() }}
        <div class="form-group" style="float: right">
            <input type="submit" id="post" class="btn btn-primary">
        </div>
        <div class="form-group">
            <input name="title" type="text" class="form-control" placeholder="输入标题" value="{{$article->title}}">
            {{--错误信息提示--}}
            @if ($errors->first('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <select name="group_id" class="custom-select form-group">
              @foreach($groups as $group)
                @if($article->group_id==$group->id)
                    <option selected value="{{$group->id}}">{{$group->name}}</option>
                @else
                    <option value="{{$group->id}}">{{$group->name}}</option>
                @endif
                
              @endforeach
            </select>
        </div>

        <div class="form-group">
            <div id="editormd">
                <textarea name="content">{{$article->content}}</textarea>
            </div>
            {{--错误信息提示--}}
            @if ($errors->first('content'))
                <span class="help-block">{{ $errors->first('content') }}</span>
            @endif
        </div>
        <input id="articleId" name="id" type="text" hidden value="{{$article->id}}">
    </form>
    <script>
        $(function() {
            var editor = editormd("editormd", {
                path : "{{config('custom.root_url')}}/../editor/lib/",// Autoload modules mode, codemirror, marked... dependents libs path
                emoji : true,
                height: 500,
                flowChart : true,             // 开启流程图支持，默认关闭
                theme : "dark",
                // Preview container theme, added v1.5.0
                // You can also custom css class .editormd-preview-theme-xxxx
                editorTheme: "blackboard",
                previewTheme : "dark",
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
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
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
            var autosave = setInterval("autosave()",3000);
            $("#post").click(function (e) {
                //清除setInterval
                clearInterval(autosave);
            });
        });

    </script>
</div>
@endsection