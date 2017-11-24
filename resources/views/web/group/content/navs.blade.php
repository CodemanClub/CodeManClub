<ul class="nav nav-tabs">
  <li class="nav-item">
    <a id="article" class="nav-link" href="{{config('custom.root_url')}}/group/content/{{$id}}/article">小组下文章</a>
  </li>
  <li class="nav-item">
    <a id="question" class="nav-link" href="{{config('custom.root_url')}}/group/content/{{$id}}/question">小组下问题</a>
  </li>
  <li class="nav-item">
    <a id="user" class="nav-link" href="{{config('custom.root_url')}}/group/content/{{$id}}/user">关注者</a>
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