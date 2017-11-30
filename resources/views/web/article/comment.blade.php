<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?0326d73869f0e1c42057054038f66fc9";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<div style="height: 30px"></div>

<link href="{{config('custom.root_url')}}/../emoji/css/emoji.css" rel="stylesheet">

<script src="{{config('custom.root_url')}}/../emoji/js/config.js"></script>
<script src="{{config('custom.root_url')}}/../emoji/js/util.js"></script>
<script src="{{config('custom.root_url')}}/../emoji/js/jquery.emojiarea.js"></script>
<script src="{{config('custom.root_url')}}/../emoji/js/emoji-picker.js"></script>
<div>
    <p>看完了，说点啥...</p>
    <form action="{{config('custom.root_url')}}/comment/post" method="post">
        {{ csrf_field() }}
        <input type="text" hidden name="article_id" value="{{$article->id}}">
        <p class="lead emoji-picker-container">
            <textarea name="content" class="form-control textarea-control" rows="3" placeholder="说点啥..." data-emojiable="true"></textarea>
        </p>
        <button type="submit" class="btn btn-success" style="float: right">发布</button>
    </form>
</div>

<script>
    $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
            emojiable_selector: '[data-emojiable=true]',
            assetsPath: "{{config('custom.root_url')}}/../emoji/img/",
            popupButtonClasses: 'fa fa-smile-o'
        });
        window.emojiPicker.discover();
    });
</script>
<div style="margin-top: 80px">
    @foreach($comments as $comment)
        <div class="card bg-light mb-3" style="width: 100%;">
            <div class="card-header">
                <h5>{{\App\User::find($comment->post_man_id)->name}}</h5>
                <button type="button" class="btn btn-primary btn-sm">点赞</button>
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="collapse" href="#{{$comment->id}}" aria-expanded="false" aria-controls="{{$comment->id}}">回复</button>
                <div class="dropdown-divider"></div>
                <div class="collapse" id="{{$comment->id}}">
                    <form action="{{config('custom.root_url')}}/comment/post" method="post">
                        {{ csrf_field() }}
                        <input type="text" hidden name="article_id" value="{{$article->id}}">
                        <p class="lead emoji-picker-container">
                            <textarea name="content" class="form-control textarea-control" rows="3" placeholder="说点啥..." data-emojiable="true">@ {{\App\User::find($comment->post_man_id)->name}}:</textarea>
                        </p>
                        <button type="submit" class="btn btn-success" style="float: right">发布</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{$comment->content}}</p>
            </div>
        </div>
    @endforeach
</div>
