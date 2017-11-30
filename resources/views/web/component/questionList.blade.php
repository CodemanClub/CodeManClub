<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?0326d73869f0e1c42057054038f66fc9";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<ul class="list-group">
    @foreach($questionList as $question)
        <div class="form-group" style="width: 100%">
            <a href="{{config('custom.root_url')}}/question/content/{{$question->id}}" style="color: black">
                <h3 class="list-group-item">{{$question->title}}</h3>
            </a>
            <li class="list-group-item">提问者：{{\App\User::find($question->post_man_id)->name}}</li>
            <li class="list-group-item">
                提问时间：{{$question->updated_at}}
            </li>
            <li class="list-group-item">{{str_limit($question->content, $limit = 200, $end = '...')}}</li>
        </div>
    @endforeach
</ul>