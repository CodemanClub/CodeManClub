@extends('web.head')

@section('title')
{{ $article->title }}
@endsection

@section('content')
<div class="container">
    {{--<link rel="stylesheet" href="http://codemanclub.com/css/article.css">--}}
    <div class="view-content">
        <link rel="stylesheet" href="{{config('custom.root_url')}}/../editor/css/editormd.min.css">
        <script src="{{config('custom.root_url')}}/../editor/editormd.min.js"></script>

        <div>
            <div id="wordsView" style=" max-width:800px; width:100%;background-color: #fcfaf2">
                @if($article->post_man_id===Auth::id())
                    <div style="float: right">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                            <a style="color: whitesmoke">删除</a>
                        </button>
                        <span style="width: 10px"></span>
                        <a style="color: whitesmoke" href="{{config('custom.root_url')}}/article/update?id={{$article->id}}">
                            <button type="button" class="btn btn-primary" value="">编辑</button>
                        </a>
                    </div>
                @endif
                <h3>{{ $article->title }}</h3>
                <h4>作者：{{\App\User::find($article->post_man_id)->name}}</h4>
                <textarea name="content">{{$article->content}}</textarea>
            </div>
            <button id="help_to_me" onclick="help_to_me()" type="button" class="btn btn-success">对我有帮助</button>
            <span><span id="help_number">{{$article->help_number}}</span>人觉得对自己有帮助</span>
            <script>
                function help_to_me() {
                    $.ajax({
                        url:"{{config('custom.root_url')}}/article/help_to_me",
                        data:{article_id:"{{$article->id}}" },
                        success:function(res){
                            $('#help_number').html(res[0].help_number); //赋值
                        }
                    });
                    $("#help_to_me").attr("disabled", true);
                }
            </script>
            <div style="max-width:800px; width:100%;background-color: #fcfaf2">
                @component('web.article.comment',['comments'=>$comments,'article'=>$article])@endcomponent
            </div>
        </div>
        <script src="{{config('custom.root_url')}}/../editor/lib/marked.min.js"></script>
        <script src="{{config('custom.root_url')}}/../editor/lib/prettify.min.js"></script>
        <script src="{{config('custom.root_url')}}/../editor/lib/raphael.min.js"></script>
        <script src="{{config('custom.root_url')}}/../editor/lib/underscore.min.js"></script>
        <script src="{{config('custom.root_url')}}/../editor/lib/sequence-diagram.min.js"></script>
        <script src="{{config('custom.root_url')}}/../editor/lib/flowchart.min.js"></script>
        <script src="{{config('custom.root_url')}}/../editor/lib/jquery.flowchart.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var wordsView;
                wordsView = editormd.markdownToHTML("wordsView", {
                    htmlDecode      : "style,script,iframe",  // you can filter tags decode
                    emoji           : true,
                    taskList        : true,
                    tex             : true,  // 默认不解析
                    flowChart       : true,  // 默认不解析
                sequenceDiagram : true,  // 默认不解析
            });

        })
        </script>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                您确定要将此状态删除吗？删除后您只能通过练习管理员恢复！！！（十天之后将彻底删除，无法恢复）
            </div>
            <div class="modal-footer">
                <a style="color: whitesmoke" href="{{config('custom.root_url')}}/article/delete?id={{$article->id}}">
                    <button type="button" class="btn btn-secondary" >确定</button>
                </a>

                <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
@endsection
