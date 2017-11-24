<ul class="nav nav-tabs">
  <li class="nav-item">
    <a id="article" class="nav-link" href="{{config('custom.root_url')}}/user/center/{{$user->id}}/article">我的文章</a>
  </li>
  <li class="nav-item">
    <a id="question" class="nav-link" href="{{config('custom.root_url')}}/user/center/{{$user->id}}/question">我的问题</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">我关注的小组</a>
  </li>
  <li class="nav-item">
    <a id="group" class="nav-link" href="{{config('custom.root_url')}}/user/center/{{$user->id}}/group">我的小组</a>
  </li>
</ul>

<script>
    $(document).ready(function(){
        var str =  window.location.href;
        var index = str .lastIndexOf("\/");
        var type  = str .substring(index + 1, str .length);
        $("#"+type).addClass("active");
    });
</script>