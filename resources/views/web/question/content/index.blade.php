@extends('web.head')

@section('title')
    {{ $question->title }}
@endsection

@section('content')
    <link rel="stylesheet" href="{{config('custom.root_url')}}/../editor/css/editormd.min.css">
    <script src="{{config('custom.root_url')}}/../editor/editormd.min.js"></script>
    <script src="{{config('custom.root_url')}}/../editor/lib/marked.min.js"></script>
    <script src="{{config('custom.root_url')}}/../editor/lib/prettify.min.js"></script>
    <script src="{{config('custom.root_url')}}/../editor/lib/raphael.min.js"></script>
    <script src="{{config('custom.root_url')}}/../editor/lib/underscore.min.js"></script>
    <script src="{{config('custom.root_url')}}/../editor/lib/sequence-diagram.min.js"></script>
    <script src="{{config('custom.root_url')}}/../editor/lib/flowchart.min.js"></script>
    <script src="{{config('custom.root_url')}}/../editor/lib/jquery.flowchart.min.js"></script>


    <div class="container">
        <div id="wordsView" style=" max-width:800px; width:100%;background-color: #fcfaf2">
            <h3>{{ $question->title }}</h3>
            <h5>提问者：{{\App\User::find($question->post_man_id)->name}}</h5>
            <textarea name="content">{{$question->content}}</textarea>
        </div>
        <div style=" max-width:800px; width:100%;background-color: #fcfaf2">
            @component('web.question.content.navs')@endcomponent
            @component('web.question.content.answers',['answerList'=>$answers,'question'=>$question])@endcomponent
        </div>
    </div>

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
@endsection