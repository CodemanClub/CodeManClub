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
    @foreach($userList as $user)
        <div class="form-group" style="width: 100%">
            <a href="{{config('custom.root_url')}}/user/center/{{$user->id}}/article" style="color: black">
                <h3 class="list-group-item">{{$user->name}}</h3>
            </a>
        </div>
    @endforeach
</ul>